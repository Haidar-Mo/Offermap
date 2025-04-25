<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Traits\{
    FirebaseNotificationTrait,
    ResponseTrait
};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\Api\V1\Dashboard\RequestCustomeNotification;
use App\Notifications\CustomNotification;
use Exception;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    use ResponseTrait, FirebaseNotificationTrait;

    public function index(Request $request)
    {
        $admin = Auth::user();
        if ($request->from && $request->to) {
            $notifications = $admin->notifications()
                ->whereBetween('created_at', [$request->from, $request->to])
                ->get();
        } else {

            $notifications = $admin->notifications()->get();
        }

        return $this->showResponse($notifications, 'done successfully..!');
    }
}
