<?php

use App\Http\Controllers\HealthMonitoringController;
use App\Http\Controllers\HealthMonitoringPdfController;
use App\Http\Controllers\LandingPageController;
use App\Livewire\HealthRecord\ByType;
use App\Livewire\HealthRecord\Download;
use App\Livewire\HealthRecord\Form;
use App\Livewire\HealthRecord\Index;
use App\Livewire\MedicalSchedule\Index as MedicalScheduleIndex;
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\Support\Index as SupportIndex;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name(name: 'welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', HomeIndex::class)->name('dashboard');

    // Page Health Record
    Route::prefix('health-records')->group(function () {
        Route::get('/', Index::class)->name('health-records.index');
        Route::get('/type/{typeId}', ByType::class)->name('health-record.by-type');
        Route::get('/create',Form::class)->name('health-records.create');
        Route::get('/download',Download::class)->name('health-records.download');
        Route::get('/monitoring/export', [HealthMonitoringPdfController::class, 'export'])->name('monitoring.export');
    });

    // Page Medical Schedule
    Route::prefix('medical-schedule')->group(function () {
        Route::get('/', MedicalScheduleIndex::class)->name('medical-schedule.index');
    });

    Route::prefix('support')->group(function () { 
        Route::get('/', SupportIndex::class)->name('support.index');
    }); 

});
use Illuminate\Http\Request;

// routes/web.php
Route::middleware(['web', 'auth'])->post('/fcm-token', function (Request $request) {
    $request->validate([
        'token' => 'required|string',
    ]);

    $user = Auth::user(); // lebih pasti daripada $request->user()

    if (!$user) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $user->fcm_token = $request->token;
    $user->save();

    return response()->json(['message' => 'Token berhasil disimpan.']);
});
