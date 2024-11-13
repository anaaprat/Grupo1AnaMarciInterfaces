<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    /**
     */
    public function index()
    {
        $events = Event::all();
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
            $originalName = $image->getClientOriginalName();
            $image->storeAs('public/imagesEvent', $originalName);
        }

        // 
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
            'image_url' => '' . $originalName ?? null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }




    /**
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
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

        // Validación de los campos del formulario
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
}
