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
            "send" => "email|nullable",
            "media" => "file|max:10240|nullable",
        ]);

        $toWho = $request->send;

        if (Auth::check()) {
            $capsuleData = [
                'name' => $request->title,
                'text' => $request->text,
                'time' => $request->time,
                'madeBy' => Auth::user()->name,
            ];

            if ($toWho == null) {
                $capsuleData['user_id'] = Auth::id();
            } else {
                $user_exists = DB::table('users')->where('email', $toWho)
                    ->exists();
                if($user_exists) {
                    $capsuleData['user_id'] =  User::where('email', $toWho)->first()->id;
                }
            }
            
            $capsule = Timecapsule::create($capsuleData);

            if($request->hasFile('media')) {
                $capsule->addMedia($request->file('media'))->toMediaCollection('Media');
            }

            $message = $toWho == null
                ? "Timecapsule was created!"
                : "Timecapsule was created and sent!";

            return redirect()->back()->with('success', $message);
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
