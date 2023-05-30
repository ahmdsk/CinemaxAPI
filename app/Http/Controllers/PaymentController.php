<?php

namespace App\Http\Controllers;

use App\Models\BookingMovie;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $booking = BookingMovie::with('movie', 'seats')->find($request->id);

        if(!is_null($booking)) {
            $booking->total_payment = $booking->seats->count() * $booking->movie['movie_price'];

            $payment = Payment::create([
                'booking_id'     => $booking->id,
                'payment_method' => $request->payment_method,
                'total_payment'  => $booking->total_payment
            ]);

            if($payment) {
                return response([
                    'message' => 'Payment Success',
                    'data' => $booking
                ], 200);
            } else {
                return response([
                    'message' => 'Payment Failed',
                    'data' => null
                ], 400);
            }
        } else {
            return response([
                'message' => 'Booking Not Found',
                'data' => null
            ], 404);
        }
    }
}
