<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Timecapsule;
use Illuminate\Support\Facades\DB;
use App\Services\TimeCapsuleService;

class AccController extends Controller
{
    public function changeAccInfo(Request $request) {
        $request->validate([
            'name' => 'nullable|max:15',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8'
        ]);

        $user = Auth::user();
        $errors = [];
        if($request->filled('name') || $request->filled('email') || $request->filled('password')) {

            if($request->filled('name')) {
                if($request->name != $user->name) {
                    //set the new username
                    $user->name = $request->name;
                }
                else {
                    $errors['name'] = 'The name is the same as the current one.';
                }
            }

            if($request->filled('email')) {
                if($request->email != $user->email) {
                    $emailExists = User::where('email', $request->email)->exists();
                    if (!$emailExists) {
                        //set the new email
                        $user->email = $request->email;
                    } else {
                        $errors['email'] = 'This email already exists in our system!';
                    }
                } else {
                    $errors['email'] = 'The email is the same as the current one';
                }
            }

            if($request->filled('password')) {
                $password = Hash::make($request->password);
                if($password != $user->password) {
                    //set the new password
                    $user->password = $password;
                } else {
                    $errors['password'] = 'The password is the same as the current one';
                }
            }

            if (empty($errors)) {
                //Saves the new user data
                $user->save();
                return redirect()->back()->with('successAcc', 'Account info updated.');
            } else {
                return redirect()->back()->withErrors($errors)->withInput();;
            }
        } else {
            return redirect()->back();
        }
    }

    public function DeleteAcc() {
        $user = Auth::user();

        //delete timecapsules
        $timecapsules = Timecapsule::where('user_id', $user->id)->get();
        foreach ($timecapsules as $timecapsule) {
            TimeCapsuleService::delete($timecapsule->id, $user->id);
        }

        //delete account
        $user->delete();
        return view('login');
        
    }
}
