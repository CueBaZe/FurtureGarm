<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimeCapsuleService {
    public function userHasTimeCapsule(User $user): bool {
        $timecapsules = DB::select('select * from timecapsules where user_id = ?', [$user->id]);
        return !empty($timecapsules);
    }
}