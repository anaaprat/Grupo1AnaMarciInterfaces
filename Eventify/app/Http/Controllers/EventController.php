<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

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
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'start_hour' => 'required|integer|between:1,24',
            'start_minute' => 'required|integer|between:0,59',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_hour' => 'required|integer|between:1,24',
            'end_minute' => 'required|integer|between:0,59',
            'location' => 'required|string|max:255',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Construir las fechas y horas completas para el evento
        $start_datetime = $request->start_date . ' ' . $request->start_hour . ':' . $request->start_minute;
        $end_datetime = $request->end_date . ' ' . $request->end_hour . ':' . $request->end_minute;
    
        // Preparar los datos para la actualización
        $dataToUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id, // El ID de la categoría seleccionada
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
            'price' => $request->price,
        ];
    
        // Manejar la imagen si se sube una nueva
        if ($request->hasFile('image_file')) {
            if ($event->image_url && \Storage::exists('public/' . $event->image_url)) {
                \Storage::delete('public/' . $event->image_url);
            }
    
            $imagePath = $request->file('image_file')->store('event_images', 'public');
            $dataToUpdate['image_url'] = $imagePath;
        }
    
        // Actualizar el evento con los datos proporcionados
        $event->update($dataToUpdate);
    
        return redirect()->route('events.index')->with('success', 'This event has been updated successfully.');
    }
    

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->deleted = 1;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
