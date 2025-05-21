<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{
    PendingNotification,
    User,
};
use App\Notifications\CustomNotification;
use Carbon\Carbon;

class SendPendingNotifications extends Command
{
    protected $signature = 'app:send-pending-notifications';
    

    public function handle()
    {
        $now = Carbon::now();

        $pendingNotifications = PendingNotification::whereDate('date', $now->toDateString())
            ->whereTime('time', '<=', $now->toTimeString())
            ->get();

        foreach ($pendingNotifications as $notification) {
            if ($notification->target === 'dealers') {

                $users = User::whereHas('store')->get();
            } elseif ($notification->target === 'users') {

                $users = User::whereDoesntHave('store')->get();
            } elseif (is_numeric($notification->target)) {

                $user = User::find($notification->target);
                if ($user) {
                    $user->notify(new CustomNotification($notification->content));
                }
                $notification->delete();
                continue;
            } else {
                continue;
            }


            foreach ($users as $user) {
                $user->notify(new CustomNotification($notification->content));
            }

            $notification->delete();
        }

        return 0;
    }
}
