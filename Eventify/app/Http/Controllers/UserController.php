<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     */
    public function index()
    {
        $users = User::where('deleted', 0)->get();
        return view('users.index', compact('users'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }


    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string',
            'profile_picture' => 'nullable|string|max:255',
            'actived' => 'required|boolean',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'This user has been updated successfully.');
    }

    /**
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted = 1;
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'This user has been deleted successfully.');
    }

    public function toggleActivation($id)
    {
        $user = User::findOrFail($id);
        $user->actived = !$user->actived;
        $user->save();

        $status = $user->actived ? 'activated' : 'deactivated';
        return redirect()->route('users.index')->with('success', "User has been {$status} successfully.");
    }
    
}