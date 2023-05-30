<?php

namespace App\Http\Controllers;

use App\Models\BookingMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingMovieController extends Controller
{
    public function index() {
        $booking = BookingMovie::with('movie', 'seats')->get();

        if(count($booking) > 0) {
            return response([
                'message' => 'Retrieve All Booking Success',
                'data' => $booking
            ], 200);
        } else {
            return response([
                'message' => 'No Booking Found',
                'data' => null
            ], 404);
        }
    }

    public function create(Request $request) {
        $booking_data = $request->only(['movie_id', 'booking_date', 'booking_time', 'seat_id']);
        
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required|exists:movies,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'seat_id' => 'required|exists:seats,id',
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $booking = BookingMovie::create($booking_data);
        if($booking) {
            // loop seat_id
            foreach($request->seat_id as $seat) {
                $booking->seats()->attach($seat);
            }

            return response([
                'message' => 'Create Booking Success',
                'data' => $booking
            ], 200);
        } else {
            return response([
                'message' => 'Create Booking Failed',
                'data' => null
            ], 400);
        }
    }
}
