<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View; // Add this import for View
use Illuminate\Http\RedirectResponse; // Add this import for RedirectResponse

class AuthController extends Controller
{
    // Display login form
    public function login(): View
    {
        return view(
            'auth.login',
            [
                'title' => 'Log in'
            ]
        );
    }

    // Authenticate user
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //redirects to  gpu-generations
            return redirect('/gpu-generations');
        }

        return back()->withErrors([
            'name' => 'Failed to authenticate',
        ]);
    }

    // End user session (log out)
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); // Log out the authenticated user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/'); // Redirect to the home page (or any other page)
    }
}
