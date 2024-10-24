<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function login(Request $request)
{
    // Validar las credenciales del usuario
    $credentials = $request->only('email', 'password');

    // Intentar autenticar al usuario
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        // Verificar si el usuario está activo
        if ($user->is_active) {
            // Redirigir según el rol del usuario
            if ($user->role === 'Admin') {
                return redirect()->route('admin.index'); // Redirigir a index para admin
            } else if ($user->role === 'User') {
                return redirect()->route('users.dashboard'); // Redirigir al dashboard para usuarios
            }
        } else {
            Auth::logout();
            return back()->withErrors(['Su cuenta no está activa.']);
        }
    }

    return back()->withErrors(['Las credenciales son incorrectas.']);
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
    public function show($id)
    {
        $user = User::findOrFail($id); // Encuentra al usuario por su ID o lanza un error 404
        return view('users.show', compact('user')); // Pasa los datos del usuario a la vista
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        // Actualizar los datos del usuario
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted = 1; // Marcamos el usuario como eliminado
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    
}