<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Timecapsule;


class TimeCapsuleService {
    public function userHasTimeCapsule(User $user): bool {
        return DB::table('timecapsules')->where('user_id', $user->id)->exists();
    }
    
    public function getTimeCapsule(User $user) {
        return DB::table('timecapsules')
        ->where('user_id', $user->id)
        ->get(['id', 'name', 'text', 'time', 'created_at', 'madeBy'])
        ->toArray();
    }

    public function getCurrentTime() {
        return date('Y-m-d');
        
    }

    public static function delete($id, $userId)
    {
        if (Timecapsule::where('id', $id)->where('user_id', $userId)) {
            $media = DB::table('medias')->where('capsule_id', $id)->first();

            if ($media && isset($media->path)) {
                Storage::disk('public')->delete($media->path);
                DB::table('medias')->where('capsule_id', $id)->delete();
            }

            return Timecapsule::where('id', $id)->where('user_id', $userId)->delete();
        }
    }
}