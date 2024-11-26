<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



class EventController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $order = $request->get('order', 'asc');

        if ($user->role === 'o') {
            $events = Event::where('organized_id', $user->id)
                ->orderBy('start_time', $order)
                ->get();
        } else {
            $events = Event::orderBy('start_time', $order)->get();
        }

        return view('events.index', compact('events'));
    }




    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'max_attendees' => 'required|integer',
            'price' => 'required|numeric',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imagePath = $image->move('storage/-+7845/imagesEvent');
            $imageName = basename($imagePath);
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'start_time' => $request->start_date . ' ' . $request->start_time,
            'end_time' => $request->end_date . ' ' . $request->end_time,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
            'price' => $request->price,
            'organized_id' => auth()->user()->id,
            'image_url' => $imageName ?? null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }


    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();

        $isOrganizer = $event->organized_id === $user->id;

        return view('events.show', compact('event', 'isOrganizer'));
    }


    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'max_attendees' => 'required|integer',
            'price' => 'required|numeric',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $startDateTime = $request->start_date . ' ' . $request->start_time . ':00';
        $endDateTime = $request->end_date . ' ' . $request->end_time . ':00';

        $dataToUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
            'price' => $request->price,
        ];

        if ($request->hasFile('image_file')) {
            if ($event->image_url && \Storage::exists('public/' . $event->image_url)) {
                \Storage::delete('public/' . $event->image_url);
            }
            $imagePath = $request->file('image_file')->store('event_images', 'public');
            $dataToUpdate['image_url'] = $imagePath;
        }

        $event->update($dataToUpdate);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }



    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        if ($event->image_path) {
            Storage::delete('public/imagesEvent/' . $event->image_path);
        }
        $event->deleted = 1;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function availableEvents(Request $request)
    {
        $user = auth()->user();
        $categories = Category::all();
        $eventos = Event::where('start_time', '>=', Carbon::tomorrow())
            ->whereDoesntHave('attendees', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('organizer')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('users.dashboard', compact('eventos', 'categories'));
    }

    public function registerEvent(Request $request, $id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        $categories = Category::all(); // Load categories


        if (!$user->attendedEvents->contains($event)) {
            $user->attendedEvents()->attach($event);
            return redirect()->route('users.dashboard')->with('success', 'You have successfully registered for the event');
        }

        return redirect()->route('users.dashboard')->with('error', 'You are already registered for this event');
    }

    public function myEvents()
    {
        $user = auth()->user();
        $eventsUser = $user->registeredEvents()->get();
        return view('users.userEvents', compact('eventsUser'));
    }

}
