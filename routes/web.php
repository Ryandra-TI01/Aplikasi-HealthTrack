<?php

use App\Http\Controllers\HealthMonitoringController;
use App\Http\Controllers\HealthMonitoringPdfController;
use App\Http\Controllers\LandingPageController;
use App\Livewire\HealthRecord\ByType;
use App\Livewire\HealthRecord\Download;
use App\Livewire\HealthRecord\Form;
use App\Livewire\HealthRecord\Index;
use App\Livewire\MedicalSchedule\Index as MedicalScheduleIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Page Health Record
    Route::prefix('health-records')->group(function () {
        Route::get('/', Index::class)->name('health-records.index');
        Route::get('/type/{typeId}', ByType::class)->name('health-record.by-type');
        Route::get('/create',Form::class)->name('health-records.create');
        Route::get('/download',Download::class)->name('health-records.download');
        Route::get('/monitoring/export', [HealthMonitoringPdfController::class, 'export'])->name('monitoring.export');
    });

    // Page Medical Schedule
    route::prefix('medical-schedule')->group(function () {
        Route::get('/', MedicalScheduleIndex::class)->name('medical-schedule.index');
    });


});