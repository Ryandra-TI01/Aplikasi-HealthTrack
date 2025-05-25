<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::where('rating', '>=', 4)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('welcome', compact('feedbacks'));
    }
}
