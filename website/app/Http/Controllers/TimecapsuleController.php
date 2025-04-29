<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timecapsule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class TimecapsuleController extends Controller
{

    public function createTimecapsule(Request $request) {
        $request->validate([
            "title" => "required|max:15",
            "text" => "required|max:300",
            "time" => "required|date|after:today",
            "send" => "email|nullable",
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

            if ($request->hasFile('media')) {
                $file = $request->file('media');

                $fileName = $file->getClientOriginalName();

                $allowed_extension = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($file_extension, $allowed_extension)) {
                     //add picture to storage
                    $path = $file->store('public/medias');
                    $pathWithoutPublic = str_replace('public/', '', $path);
                    $url = Storage::url($pathWithoutPublic);

                    //add picture to database
                    DB::table('medias')->insert([
                        'capsule_id' => $capsule->id,
                        'name' => $fileName,
                        'path' => $pathWithoutPublic
                    ]);
                }
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
        $timecapsule = Timecapsule::find($id);
        $user_id = auth::id();

        $media = DB::table('medias')->where('capsule_id', $id)->first();

        if ($media && isset($media->path)) {
            Storage::delete('public/' . $media->path);
        }

        DB::table('medias')->where('capsule_id', $id)->delete();

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
