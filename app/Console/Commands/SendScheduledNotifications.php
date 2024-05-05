<?php

namespace App\Console\Commands;

use Kreait\Firebase\Factory;
use Illuminate\Console\Command;
use App\Models\ScheduledNotification;
use Kreait\Firebase\Messaging\CloudMessage;

class SendScheduledNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send scheduled notifications';
    public function handle()
    {
        $now = now();
        $notifications = ScheduledNotification::where('scheduled_at', '<=', $now)->get();

        $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
        $messaging = $factory->createMessaging();

        foreach ($notifications as $notification) {
            // Construct the CloudMessage object
            $message = CloudMessage::withTarget('token', $notification->user->fcm_token)
                ->withNotification([
                    'title' => 'Notification',
                    'body' => $notification->message,
                ]);

            // Send the message via Firebase
            $messaging->send($message);

            // Delete the notification or mark it as sent
            $notification->delete();
        }
    }
}
