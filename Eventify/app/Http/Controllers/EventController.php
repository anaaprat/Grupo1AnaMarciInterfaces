<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category; // Asegúrate de importar el modelo Category

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los eventos de la base de datos
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las categorías para mostrarlas en el formulario
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
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
        ]);

        // Combinar fecha y hora para obtener la fecha completa
        $start_datetime = $request->start_date . ' ' . $request->start_hour . ':' . $request->start_minute;
        $end_datetime = $request->end_date . ' ' . $request->end_hour . ':' . $request->end_minute;

        // Crear el evento en la base de datos
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
            'price' => $request->price,
        ]);

        // Redirigir al listado de eventos con un mensaje de éxito
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar un evento específico
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el evento y las categorías
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
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
        ]);

        // Encontrar el evento y actualizarlo
        $event = Event::findOrFail($id);

        $start_datetime = $request->start_date . ' ' . $request->start_hour . ':' . $request->start_minute;
        $end_datetime = $request->end_date . ' ' . $request->end_hour . ':' . $request->end_minute;

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'location' => $request->location,
            'max_attendees' => $request->max_attendees,
            'price' => $request->price,
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
