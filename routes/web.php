<?php

use App\Http\Controllers\DailyTimeController;
use App\Http\Controllers\ProfileController;
use App\Models\DailyTime;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    // dd(request('editDailyTime'));
    return view('dashboard', [
        'randomQuote' => Quote::inRandomOrder()->first(),
        'editDailyTime' => (bool) request('editDailyTime'),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/friends', function () {
    return view('friends');
})->middleware(['auth', 'verified'])->name('friends');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/dailytime', [DailyTimeController::class, 'store'])->middleware(['auth', 'verified'])->name('dailytime.store');
Route::put('/dailytime', [DailyTimeController::class, 'update'])->middleware(['auth', 'verified'])->name('dailytime.update');

Route::get('/dabdab', function () {

    $user = User::find(52);

    incrementStreak($user);


    return shouldStreakBeIncremented($user) ? 'true' : 'false';
    // return $user;
});

require __DIR__ . '/auth.php';
