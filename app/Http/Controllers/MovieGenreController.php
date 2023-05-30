<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieGenre;
use Illuminate\Support\Facades\Validator;

class MovieGenreController extends Controller
{
    public function index()
    {
        $movie_genre = MovieGenre::all();

        if (count($movie_genre) > 0) {
            return response()->json([
                'message' => 'Retrieve All Genre Movie Success',
                'data'    => $movie_genre
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Genre Movie Found',
                'data'    => null
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $movie_genre = $request->only('movie_genre_name', 'movie_id');

        $validator = Validator::make($movie_genre, [
            'movie_genre_name'    => 'required',
            'movie_id'            => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create_seat = MovieGenre::create($movie_genre);
        if ($create_seat) {
            return response()->json([
                'message'   => 'Create Movie Genre Success',
                'data'      => $movie_genre
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Create Movie Genre Failed',
                'data'      => null
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $movie_genre = $request->only('movie_genre_name', 'movie_id');

        $validator = Validator::make($movie_genre, [
            'movie_genre_name'    => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $update_genre = MovieGenre::where('id', $id)->update($movie_genre);
        if ($update_genre) {
            return response()->json([
                'message'   => 'Update Genre Success',
                'data'      => $movie_genre
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Update Genre Failed',
                'data'      => null
            ], 400);
        }
    }

    public function delete($id) {
        $genre = MovieGenre::find($id);

        if ($genre) {
            $genre->delete();
            return response()->json([
                'message'   => 'Delete Genre Success',
                'data'      => $genre
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Delete Genre Failed, Genre Not Found!',
                'data'      => null
            ], 400);
        }
    }
}
