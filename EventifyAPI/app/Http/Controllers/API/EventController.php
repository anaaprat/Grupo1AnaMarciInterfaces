<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{
    
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'success' => true,
            'data' => $events,
            'message' => 'Events retrieved successfully.',
        ], 200);
    }

    public function view()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event retrieved successfully.',
        ], 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'organized_id' => 'required|integer',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|integer',
        'start_time' => 'required|date',
        'end_time' => 'required|date',
        'location' => 'required|string|max:255',
        'max_attendees' => 'required|integer',
        'price' => 'required|numeric',
        'image_url' => 'nullable|url', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $event = Event::create($request->all());
    return response()->json([
        'success' => true,
        'data' => $event,
        'message' => 'Event created successfully.',
    ], 201);
}


  
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'location' => 'string|max:255',
            'max_attendees' => 'integer',
            'price' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $event->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event updated successfully.',
        ], 200);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.',
            ], 404);
        }

        $event->delete();
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ], 200);
    }
}
