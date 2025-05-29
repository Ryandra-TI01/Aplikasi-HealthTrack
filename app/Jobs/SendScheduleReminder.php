<?php

namespace App\Jobs;

use App\Models\MedicalSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;


class SendScheduleReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $now = now();
        $offsets = [15, 10, 5, 0]; // Minutes before reminder_time

        $messaging = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/firebase_credentials.json'))
            ->createMessaging();

        foreach ($offsets as $offset) {
            $target = $now->copy()->addMinutes($offset);

            $schedules = MedicalSchedule::where('reminder_time', '>=', $target->copy()->subMinute())
                ->where('reminder_time', '<=', $target->copy()->addMinute())
                ->where(function ($query) use ($offset) {
                    $query->whereNull("notified_{$offset}");
                })
                ->with('user')
                ->get();

            foreach ($schedules as $schedule) {
                if (!$schedule->user || !$schedule->user->fcm_token) {
                    continue;
                }

                try {
                    $message = CloudMessage::fromArray([
                        'token' => $schedule->user->fcm_token,
                        'notification' => [
                            'title' => 'Pengingat Jadwal',
                            'body' => $schedule->title,
                            'image' => 'https://github.com/Ryandra-TI01/Aplikasi-HealthTrack/blob/main/public/images/Logo-HealthTrack-circle.png?raw=true',
                            'click_action' => 'http://127.0.0.1:8000/medical-schedule' // <== di sini!
                        ],
                        'data' => [
                            'schedule_id' => (string)$schedule->id,
                            'type' => $schedule->type,
                            'url' => 'http://127.0.0.1:8000/medical-schedule' // redundant utk jaga-jaga
                        ]
                    ]);

                    $messaging->send($message);

                    $schedule->{"notified_{$offset}"} = now();
                    $schedule->save();

                } catch (\Kreait\Firebase\Exception\MessagingException $e) {
                    Log::error("FCM Error for schedule #{$schedule->id}: " . $e->getMessage());
                }
            }
        }

        // Handle repeat interval
        MedicalSchedule::where('reminder_time', '<=', now())
            ->where('repeat_interval', '!=', 'none')
            ->each(function ($schedule) {
                switch ($schedule->repeat_interval) {
                    case 'daily':
                        $schedule->reminder_time = $schedule->reminder_time->addDay();
                        break;
                    case 'weekly':
                        $schedule->reminder_time = $schedule->reminder_time->addWeek();
                        break;
                    case 'monthly':
                        $schedule->reminder_time = $schedule->reminder_time->addMonth();
                        break;
                }

                $schedule->notified_15 = null;
                $schedule->notified_10 = null;
                $schedule->notified_5 = null;
                $schedule->notified_0 = null;

                $schedule->save();
            });
    }
}