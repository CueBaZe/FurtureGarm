<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function login(Request $request) {
        $request->validate([
            "email" => "required||email",
            "password" => "required",
        ]);

        $credentials = $request->only("email", "password", "rem");

        dd($credentials);
    }

    public function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required||email",
            "password" => "required||min:8",
            "terms" => "accepted",
        ], [
            "terms.accepted" => "You must accept the terms and conditions to proceed."
        ]);

        $credentials = $request->only("name", "email", "password", "term");

        dd($credentials);
    }
}
