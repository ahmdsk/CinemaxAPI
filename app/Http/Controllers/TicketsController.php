<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Tickets::all();

        if (count($tickets) > 0) {
            return response()->json([
                'message' => 'Retrieve All Tickets Success',
                'data'    => $tickets
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Tickets Found',
                'data'    => null
            ], 404);
        }
    }
}
