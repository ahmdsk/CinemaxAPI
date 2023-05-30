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
            $data_booking = $booking->map(function($item) {
                $item->total_payment = $item->seats->count() * $item->movie['movie_price'];
    
                return $item;
            });

            return response([
                'message' => 'Retrieve All Booking Success',
                'data' => $data_booking
            ], 200);
        } else {
            return response([
                'message' => 'No Booking Found',
                'data' => null
            ], 404);
        }
    }

    public function show($id) {
        $booking = BookingMovie::with('movie', 'seats')->find($id);

        if(!is_null($booking)) {
            $booking->total_payment = $booking->seats->count() * $booking->movie['movie_price'];

            return response([
                'message' => 'Retrieve Booking Success',
                'data' => $booking
            ], 200);
        } else {
            return response([
                'message' => 'Booking Not Found',
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
