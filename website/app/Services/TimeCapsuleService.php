<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimeCapsuleService {
    public function userHasTimeCapsule(User $user): bool {
        return DB::table('timecapsules')->where('user_id', $user->id)->exists();
    }
    
    public function getTimeCapsule(User $user) {
        return DB::table('timecapsules')
        ->where('user_id', $user->id)
        ->get(['id', 'name', 'text', 'time'])
        ->toArray();
    }
}