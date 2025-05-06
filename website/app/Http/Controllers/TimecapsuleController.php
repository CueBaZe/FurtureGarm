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
        $request->validate([ //validates the title, text, time and send.
            "title" => "required|max:15", 
            "text" => "required|max:300",
            "time" => "required|date|after:today",
            "send" => "email|nullable", //can be null
            "media" => "nullable|file|mimes:jpg,jpeg,png,gif,mp4,ogg,webm|max:524288"
        ]);

        $toWho = $request->send;

        if (Auth::check()) { //checks if the user is logged in
            $capsuleData = [ //get all the data into an array
                'name' => $request->title,
                'text' => $request->text,
                'time' => $request->time,
                'madeBy' => Auth::user()->name,
            ];

            if ($toWho == null) { //check if user chose to send it to another person
                $capsuleData['user_id'] = Auth::id();
            } else {
                $user_exists = DB::table('users')->where('email', $toWho)
                    ->exists(); 
                if($user_exists) { //check if that user exists
                    $capsuleData['user_id'] =  User::where('email', $toWho)->first()->id; //get the users id
                }

            }

            $capsule = Timecapsule::create($capsuleData); //creates the timecapsule

            if ($request->hasFile('media')) { //checks if user added any media
                $file = $request->file('media');

                $fileName = $file->getClientOriginalName();

                $allowed_extension = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'ogg', 'webm'];
                $file_extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($file_extension, $allowed_extension)) { //checks if the extension is allowed
                     //add picture to storage
                    $path = $file->store('medias', 'public'); // stored in storage/app/public/medias
                    $pathWithoutPublic = str_replace('public/', '', $path);
                    $url = Storage::url($pathWithoutPublic);

                    //add picture to database
                    DB::table('medias')->insert([ //Saves the media in the database
                        'capsule_id' => $capsule->id,
                        'name' => $fileName,
                        'path' => $pathWithoutPublic,
                        'extension' => $file_extension,
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

    public function getMediaPath($id) {
        $capsule = Timecapsule::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$capsule) {
            return response()->json(['path' => null], 403); //forbidden
        }

        $media = DB::Table('medias')->where('capsule_id', $id)->first(); //gets the media where capsule_id = $id
        
        if ($media && isset($media->path)) { //if there is any sends the path with json
            return response()->json([
                'path' => Storage::url($media->path),
                'extension' => $media->extension,
            ]);
        }

        return response()->json(['path' => null]);
    }

    public function deleteTimecapsule(Request $request) {
        $id = $request->id;
        $timecapsule = Timecapsule::find($id);
        $user_id = auth::id();

        $media = DB::table('medias')->where('capsule_id', $id)->first();
        //deletes the media from the database and the storage
        if ($media && isset($media->path)) { //checks if theres any media in the capsule
            Storage::disk('public')->delete($media->path);

            DB::table('medias')->where('capsule_id', $id)->delete(); //deletes the capsule from the database
        }

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
