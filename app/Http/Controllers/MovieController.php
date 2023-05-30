<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genres', 'actors')->get();

        if (count($movies) > 0) {
            return response()->json([
                'message' => 'Retrieve All Movies Success',
                'data'    => $movies
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Movies Found',
                'data'    => null
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $movie = $request->only('movie_name', 'movie_duration', 'movie_price', 'movie_status', 'release_date', 'movie_img', 'description');

        $validator = Validator::make($movie, [
            'movie_name'        => 'required',
            'movie_duration'    => 'required',
            'movie_status'      => 'required',
            'movie_price'       => 'required',
            'movie_img'         => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // if image exists
        if ($request->hasFile('movie_img')) {
            $file = $request->file('movie_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/movie/', $filename);
            $movie['movie_img'] = $filename;
        }

        $create_movie = Movie::create($movie);
        if ($create_movie) {
            return response()->json([
                'message'   => 'Create Movie Success',
                'data'      => $movie
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Create Movie Failed',
                'data'      => null
            ], 400);
        }
    }

    public function create_genre(Request $request) {
        $movie = Movie::find($request->movie_id);
        $movie->genres()->attach($request->genre_id);

        return response()->json([
            'message'   => 'Create Genre Success',
            'data'      => $movie
        ], 200);
    }

    public function update(Request $request)
    {
        $movie = $request->only('movie_name', 'movie_duration', 'movie_price', 'movie_status', 'release_date', 'movie_img', 'description');

        $validator = Validator::make($movie, [
            'movie_name'        => 'required',
            'movie_duration'    => 'required',
            'movie_status'      => 'required',
            'movie_price'       => 'required',
            'movie_img'         => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // if image exists
        if ($request->hasFile('movie_img')) {
            $file = $request->file('movie_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/movie/', $filename);
            $movie['movie_img'] = $filename;
        }

        $update_movie = Movie::where('id', $request->id)->update($movie);
        if ($update_movie) {
            return response()->json([
                'message'   => 'Update Movie Success',
                'data'      => $movie
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Update Movie Failed',
                'data'      => null
            ], 400);
        }
    }

    public function delete(Request $request) {
        $movie = Movie::find($request->id);

        if ($movie) {
            $movie->delete();
            return response()->json([
                'message'   => 'Delete Movie Success',
                'data'      => $movie
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Delete Movie Failed, Movie Not Found!',
                'data'      => null
            ], 400);
        }
    }
}
