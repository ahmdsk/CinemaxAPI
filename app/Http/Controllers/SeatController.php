<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::all();

        if (count($seats) > 0) {
            return response()->json([
                'message' => 'Retrieve All Seat Success',
                'data'    => $seats
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Seat Found',
                'data'    => null
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $seat = $request->only('seat_code');

        $validator = Validator::make($seat, [
            'seat_code'    => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create_seat = Seat::create($seat);
        if ($create_seat) {
            return response()->json([
                'message'   => 'Create Seat Success',
                'data'      => $seat
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Create Seat Failed',
                'data'      => null
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $seat = $request->only('seat_code');

        $validator = Validator::make($seat, [
            'seat_code'    => 'required',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $update_seat = Seat::where('id', $request->id)->update($seat);
        if ($update_seat) {
            return response()->json([
                'message'   => 'Update Seat Success',
                'data'      => $seat
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Update Seat Failed',
                'data'      => null
            ], 400);
        }
    }

    public function delete(Request $request) {
        $seat = Seat::find($request->id);

        if ($seat) {
            $seat->delete();
            return response()->json([
                'message'   => 'Delete Seat Success',
                'data'      => $seat
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Delete Seat Failed, Seat Not Found!',
                'data'      => null
            ], 400);
        }
    }
}
