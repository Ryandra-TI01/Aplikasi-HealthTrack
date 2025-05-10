<?php

use App\Livewire\HealthRecord\ByType;
use App\Livewire\HealthRecord\Form;
use App\Livewire\HealthRecord\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
    });


});