<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\TimeCapsuleService;

class HomePageComposer {
    protected $timeCapsuleService;

    public function __construct(TimeCapsuleService $timeCapsuleService) {
        $this->timeCapsuleService = $timeCapsuleService;
    }

    public function compose(View $view) {
        $user = auth()->user();
        $hasTimeCapsule = $user ? $this->timeCapsuleService->userHasTimeCapsule($user) : false;

        $view->with('hasTimeCapsule', $hasTimeCapsule);
    }
}