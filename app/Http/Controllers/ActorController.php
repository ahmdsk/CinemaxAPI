<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    public function index()
    {
        $actor = Actor::all();

        if (count($actor) > 0) {
            return response()->json([
                'message' => 'Retrieve All Actors Success',
                'data'    => $actor
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Actors Found',
                'data'    => null
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $actor = $request->only('name', 'img', 'movie_id');

        $validator = Validator::make($actor, [
            'name'      => 'required',
            'movie_id'  => 'required',
            'img'       => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // if image exists
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/actor/', $filename);
            $actor['img'] = $filename;
        }

        $create_actor = Actor::create($actor);
        if ($create_actor) {
            return response()->json([
                'message'   => 'Create Actor Success',
                'data'      => $actor
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Create Actor Failed',
                'data'      => null
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $actor = $request->only('name', 'img', 'movie_id');

        $validator = Validator::make($actor, [
            'name'      => 'required',
            'movie_id'  => 'required',
            'img'       => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update image
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/actor/', $filename);
            $actor['img'] = $filename;
        }

        $update_actor = Actor::where('id', $request->id)->update($actor);
        if ($update_actor) {
            return response()->json([
                'message'   => 'Update Actor Success',
                'data'      => $actor
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Update Actor Failed',
                'data'      => null
            ], 400);
        }
    }

    public function delete(Request $request) {
        $actor = Actor::find($request->id);

        if ($actor) {
            $actor->delete();
            return response()->json([
                'message'   => 'Delete Actor Success',
                'data'      => $actor
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Delete Actor Failed, Actor Not Found!',
                'data'      => null
            ], 400);
        }
    }
}
