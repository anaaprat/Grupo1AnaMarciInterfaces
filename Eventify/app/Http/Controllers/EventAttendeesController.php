<?php

namespace App\Http\Controllers;

use App\Models\Event_Attendees;
use Illuminate\Http\Request;

class EventAttendeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event_Attendees $event_Attendees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event_Attendees $event_Attendees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event_Attendees $event_Attendees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventId)
    {
        $user = auth()->user();

        $attendee = Event_Attendees::where('user_id', $user->id)->where('event_id', $eventId)->first();

        if ($attendee) {
            $attendee->delete();

            return redirect()->route('users.userEvents')->with('success', 'You have been unregistered from the event.');
        }

        return redirect()->route('users.userEvents')->with('error', 'You were not registered for this event.');
    }


}
