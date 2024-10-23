<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    protected function redirectTo()
    {
        if (Auth::user()->role === 'Admin') {
            return route('users.index');  // Vista de admin
        }

        return route('user.dashboard');  // Vista de usuario regular
    }

}
