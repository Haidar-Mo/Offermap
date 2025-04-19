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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pending-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $pendingNotifications = PendingNotification::whereDate('date', $now->toDateString())
            ->whereTime('time', '<=', $now->toTimeString())
            ->get();
        foreach ($pendingNotifications as $notification) {
            if ($notification->target === 'dealers') {

                $users = User::whereHas('roles', function ($query) {
                    $query->whereIn('name', ['dealers']);
                })->get();
                foreach ($users as $user) {
                    $user->notify(new CustomNotification($notification->content));
                }
            } elseif ($notification->target === 'users') {

                $users = User::whereHas('roles', function ($query) {
                    $query->whereIn('name', ['client']);
                })->get();
                foreach ($users as $user) {
                    $user->notify(new CustomNotification($notification->content));
                }
            } elseif (is_numeric($notification->target)) {

                $user = User::find($notification->target);
                if ($user) {
                    $user->notify(new CustomNotification($notification->content));
                }
            }


            $notification->delete();
        }

        return 0;
    }
}
