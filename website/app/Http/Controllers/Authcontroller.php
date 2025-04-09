<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function login(Request $request) {
        $request->validate([
            "email" => "required||email",
            "password" => "required",
        ]);

        $credentials = $request->only("email", "password");

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('login')->with('error', 'Invalid credentials. Please try again');
    }

    public function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required||email|unique:users",
            "password" => "required||min:8",
            "terms" => "accepted",
        ], [
            "terms.accepted" => "You must accept the terms and conditions to proceed."
        ]);

        $credentials = $request->only("name", "email", "password", "term");

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'User was successfully created');
    }
}
