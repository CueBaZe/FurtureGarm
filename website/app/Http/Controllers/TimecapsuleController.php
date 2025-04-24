<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timecapsule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;


class TimecapsuleController extends Controller
{
    public function createTimecapsule(Request $request) {
        $request->validate([
            "title" => "required|max:15",
            "text" => "required|max:300",
            "time" => "required|date|after:today",
            "send" => "email||nullable",
        ]);

        $toWho = $request->send;

        if (Auth::check()) {
            if ($toWho == null) {
                Timecapsule::create([
                    'user_id' => Auth::id(),
                    'name' => $request->title,
                    "text" => $request->text,
                    "time" => $request->time,
                    "madeBy" => Auth::user()->name,
                ]);
                return redirect()->back()->with('success', "Timecapsule was created!");
            } else {
                $user_exists = DB::table('users')->where('email', $toWho)
                    ->exists();
                if($user_exists) {
                    $user_id =  User::where('email', $toWho)->first();
                    timecapsule::create([
                        'user_id' => $user_id->id,
                        'name' => $request->title,
                        "text" => $request->text,
                        "time" => $request->time,
                        "madeBy" => Auth::user()->name,
                    ]);
                    return redirect()->back()->with('success', "Timecapsule was created!");
                } else {
                    return redirect()->back()->withErrors(['send' => "This email is not in our database."]);
                }
            }
        } else {
            return redirect()->route('login');
        }

    }

    public function deleteTimecapsule(Request $request) {
        $id = $request->id;
        $user_id = auth::id();
        
        $deleted = Timecapsule::where('id', $id)
            ->where('user_id', $user_id)
            ->delete();

        if ($deleted) {
            return redirect()->route('home')->with('successdel', 'Timecapsule was deleted successfully!');
        } else {
            return redirect()->route('home')->with('error', 'Timecapsule not found or unauthorized.');
        }
    }
}
