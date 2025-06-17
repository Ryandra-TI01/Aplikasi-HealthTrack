<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            ['user_id' => 1, 'message' => 'The app is very easy to use and helps me track my health daily.', 'rating' => 5],
            ['user_id' => 2, 'message' => 'I like the interface, but sometimes it lags when loading data.', 'rating' => 4],
            ['user_id' => 3, 'message' => 'Great features, especially the reminder for taking medicine.', 'rating' => 5],
            ['user_id' => 4, 'message' => 'The health tips are useful, but I wish there were more of them.', 'rating' => 4],
            ['user_id' => 5, 'message' => 'Not bad, but the UI could be improved on smaller screens.', 'rating' => 3],
            ['user_id' => 6, 'message' => 'I had trouble logging in a few times, but overall it works well.', 'rating' => 3],
            ['user_id' => 7, 'message' => 'I appreciate how the app tracks my blood pressure daily.', 'rating' => 5],
            ['user_id' => 8, 'message' => 'Good app, but syncing data between devices is not smooth.', 'rating' => 4],
            ['user_id' => 9, 'message' => 'This app really helped me monitor my recovery after surgery.', 'rating' => 5],
            ['user_id' => 10, 'message' => 'Decent, but lacks integration with my fitness tracker.', 'rating' => 3],
            ['user_id' => 11, 'message' => 'The reminders help me stay consistent with my medication.', 'rating' => 5],
            ['user_id' => 12, 'message' => 'Could use more language support for non-English users.', 'rating' => 4],
            ['user_id' => 13, 'message' => 'Very insightful data charts. Makes it easier to understand trends.', 'rating' => 5],
            ['user_id' => 14, 'message' => 'I experienced some crashes on older phones.', 'rating' => 2],
            ['user_id' => 15, 'message' => 'Solid app. Would love a dark mode option though.', 'rating' => 4],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::create([
                'user_id' => $feedback['user_id'],
                'message' => $feedback['message'],
                'rating' => $feedback['rating'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
