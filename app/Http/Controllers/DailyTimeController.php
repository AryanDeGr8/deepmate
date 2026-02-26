<?php

namespace App\Http\Controllers;

use App\Models\DailyTime;
use App\Http\Requests\StoreDailyTimeRequest;
use App\Http\Requests\UpdateDailyTimeRequest;
use Illuminate\Support\Facades\Auth;

class DailyTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyTimeRequest $request)
    {
        //
        $validated = $request->validate([
            'hours' => ['required', 'integer', 'min:0', 'max:23'],
            'minutes' => ['required', 'integer', 'min:0', 'max:59']
        ]);

        $hours = (int) $validated['hours'];
        $minutes = (int) $validated['minutes'];

        $time = $hours * 60 + $minutes;

        // create new dailytime or update today's dailytime if streak should not be incremented


        $dailyTime = DailyTime::create([
            'time' => $time,
            'date' => today(),
            'user_id' => Auth::user()->id,
        ]);


        incrementStreak(Auth::user());
        updateLastLogged(Auth::user());

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyTime $dailyTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyTime $dailyTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyTimeRequest $request)
    {
        //
        $validated = $request->validate([
            'hours' => ['required', 'integer', 'min:0', 'max:23'],
            'minutes' => ['required', 'integer', 'min:0', 'max:59']
        ]);

        $hours = (int) $validated['hours'];
        $minutes = (int) $validated['minutes'];

        $time = $hours * 60 + $minutes;

        $dailyTime = getTodaysDailyTime(Auth::user());

        $dailyTime->time = $time;

        $dailyTime->save();

        return redirect('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyTime $dailyTime)
    {
        //
    }
}
