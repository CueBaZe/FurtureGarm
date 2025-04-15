<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timecapsule;
use Illuminate\Support\Facades\Auth;

class TimecapsuleController extends Controller
{
    public function createTimecapsule(Request $request) {
        $request->validate([
            "title" => "required|max:15",
            "text" => "required|max:300",
            "time" => "required|date|after:today",
        ]);

        if (Auth::check()) {
            Timecapsule::create([
                'user_id' => Auth::id(),
                'name' => $request->title,
                "text" => $request->text,
                "time" => $request->time,
            ]);
            return redirect()->back()->with('success', "Time capsule created!");
        } else {
            return redirect()->route('login');
        }

    }
}
