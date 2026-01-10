<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($activity, $endpoint)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'endpoint' => $endpoint,
        ]);
    }
}
