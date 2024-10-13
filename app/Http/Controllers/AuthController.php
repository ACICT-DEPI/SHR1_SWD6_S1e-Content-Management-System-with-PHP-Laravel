<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
            // Handle image upload
            $imgPath = null;
            if ($request->hasFile('img')) {
                $imgPath = $request->file('img')->store('images', 'public');
            }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img' => $imgPath,

        ]);


        // Log the user in
        Auth::login($user);
        return redirect()->route('frontend.home')->with('success', 'Registration successful!');;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the user is an admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('home'); // Redirect to admin dashboard
            } else {
                return redirect()->route('frontend.home'); // Redirect to user dashboard
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
