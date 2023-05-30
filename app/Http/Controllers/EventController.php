<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        if (count($events) > 0) {
            return response()->json([
                'message' => 'Retrieve All Events Success',
                'data'    => $events
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Events Found',
                'data'    => null
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $event = $request->only('event_name', 'event_price', 'event_img');

        $validator = Validator::make($event, [
            'event_name'    => 'required',
            'event_price'   => 'required',
            'event_img'     => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $create_event = Event::create($event);
        if ($create_event) {
            return response()->json([
                'message'   => 'Create Event Success',
                'data'      => $event
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Create Event Failed',
                'data'      => null
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $event = $request->only('event_name', 'event_price', 'event_img');

        $validator = Validator::make($event, [
            'event_name'    => 'required',
            'event_price'   => 'required',
            'event_img'     => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $update_event = Event::where('id', $request->id)->update($event);
        if ($update_event) {
            return response()->json([
                'message'   => 'Update Event Success',
                'data'      => $event
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Update Event Failed',
                'data'      => null
            ], 400);
        }
    }

    public function delete(Request $request) {
        $event = Event::find($request->id);

        if ($event) {
            $event->delete();
            return response()->json([
                'message'   => 'Delete Event Success',
                'data'      => $event
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Delete Event Failed, Event Not Found!',
                'data'      => null
            ], 400);
        }
    }
}
