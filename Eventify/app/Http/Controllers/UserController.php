<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostrar listado de usuarios.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario (pendiente de implementación).
     */
    public function create()
    {
        //
    }

    /**
     * Almacenar un nuevo usuario en la base de datos (pendiente de implementación).
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar un usuario específico.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar los datos de un usuario en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string',
            'profile_picture' => 'nullable|string|max:255',
            'actived' => 'required|boolean',
        ]);

        // Actualizar los datos del usuario
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar (soft delete) un usuario específico.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted = 1; // Marcamos al usuario como eliminado
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}