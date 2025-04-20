<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timecapsule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return redirect()->back()->with('success', "Timecapsule created!");
        } else {
            return redirect()->route('login');
        }

    }

    public function deleteTimecapsule(Request $request) {
        $id = $request->id;
        DB::table('timecapsules')->where('id', $id)->delete();
        return redirect()->route('home');
    }
}
