<?php

use App\Http\Controllers\DailyTimeController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\DailyTime;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/dashboard', function () {

    // dd(request('editDailyTime'));
    return view('dashboard', [
        'randomQuote' => Quote::inRandomOrder()->first(),
        'editDailyTime' => (bool) request('editDailyTime'),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/friends', [FriendshipController::class, 'index'])->name('friends');
    Route::post('/friends', [FriendshipController::class, 'store'])->name('friends.store');
    Route::patch('/friends/{friendship}', [FriendshipController::class, 'update'])->name('friends.update');
    Route::delete('/friends/{friendship}', [FriendshipController::class, 'destroy'])->name('friends.destroy');

    Route::get('/friends/add', SearchController::class)->name('friends.add');
    Route::get('/friends/requests', [FriendshipController::class, 'index'])->name('friends.requests');
    Route::get('/profile/blocked', [FriendshipController::class, 'index'])->name('profile.blocked');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/dailytime', [DailyTimeController::class, 'store'])->middleware(['auth', 'verified'])->name('dailytime.store');
Route::put('/dailytime', [DailyTimeController::class, 'update'])->middleware(['auth', 'verified'])->name('dailytime.update');



Route::get('/dabdab', function () {

    $user = User::find(52);



    return $user->receivedBlocks;
    // return $user;
});

// Route::view('/hello', 'helloworld')->name('hello');


require __DIR__ . '/auth.php';
