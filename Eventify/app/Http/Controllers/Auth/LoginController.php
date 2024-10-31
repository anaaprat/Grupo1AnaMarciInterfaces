<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        return $user->role === 'a' ? '/users' : '/';
    }

    /**     
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**     
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'This account doesn´t exist.']);
        }

        if (!$user->email_confirmed) {
            return redirect()->back()->withErrors(['error' => 'This account hasn´t been confirmed yet.']);
        }

        if (!$user->actived) {
            return redirect()->back()->withErrors(['error' => 'This account hasn´t been activated by the administrator, please wait.']);
        }

        if ($user->deleted) {
            return redirect()->back()->withErrors(['error' => 'This account has been eliminated']);
        }

        if (Auth::attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }

        return redirect()->back()->withErrors(['error' => 'The credentials are incorrect.']);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->actived) { 
            Auth::logout();
            return redirect()->route('emailverified')->withErrors(['error' => 'Tu cuenta aún no ha sido activada por el administrador.']);
        }

        return redirect()->intended($this->redirectPath());
    }
}
