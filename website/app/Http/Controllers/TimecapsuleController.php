<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimecapsuleController extends Controller
{
    public function createTimecapsule(Request $request) {
        $request->validate([
            "title" => "required",
            "text" => "required|max:300",
            "time" => "required",
        ]);
    }
}
