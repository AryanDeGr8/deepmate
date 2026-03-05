<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DivisionByZeroError;
use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_logged' => 'date:m/d/Y',

        ];
    }





    // Friendship Logic

    public function sentFriendRequests()
    {
        return $this->sentFriendships()->wherePivot('status', '=', 'pending');
    }

    public function receivedFriendRequests()
    {
        return $this->receivedFriendships()->wherePivot('status', '=', 'pending');
    }

    public function sentBlocks()
    {
        return $this->sentFriendships()->wherePivot('status', '=', 'blocked');
    }

    public function receivedBlocks()
    {
        return $this->receivedFriendships()->wherePivot('status', '=', 'blocked');
    }

    public function friends()
    {
        return $this->sentAcceptedRequests->merge($this->receivedAcceptedRequests);
    }

    public function sentAcceptedRequests()
    {
        return $this->sentFriendships()->wherePivot('status', '=', 'accepted');
    }

    public function receivedAcceptedRequests()
    {
        return $this->receivedFriendships()->wherePivot('status', '=', 'accepted');
    }

    public function sentFriendships()
    {
        return $this->belongsToMany(User::class, 'friendships', 'requester_id', 'addressee_id')->withPivot('id', 'status');
    }

    public function receivedFriendships()
    {
        return $this->belongsToMany(User::class, 'friendships', 'addressee_id', 'requester_id')->withPivot('id', 'status');
    }





    // DailyTime Logic
    public function getTodaysDailyTime()
    {
        return $this->dailyTimes()->where('date', '=', today())->first();

    }


    public function dailyTimes()
    {
        return $this->hasMany(DailyTime::class);

    }

    public function avgTime()
    {
        return $this->dailyTimes()->avg('time');
    }

    public function daysWorked()
    {
        return $this->dailyTimes()->count('time');
    }

    public function maxTime()
    {
        return $this->dailyTimes()->max('time');

    }

    public function lifetimeTime()
    {
        return $this->dailyTimes()->sum('time');

    }

    public function thisWeeksTime()
    {
        try {
            $thisWeeksTime = $this->dailyTimes()->orderBy('date', 'desc')->get()->groupBy(function ($data) {
                return $data->date->format('Y-W');
            })->map(function ($entry) {
                return [
                    'time' => $entry->sum('time'),
                ];
            })->toArray()[today()->format('Y-W')]['time'];
        } catch (ErrorException) {
            $thisWeeksTime = 0;
        }

        return $thisWeeksTime;
    }

    public function thisMonthsTime()
    {
        try {
            $thisMonthsTime = $this->dailyTimes()->orderBy('date', 'desc')->get()->groupBy(function ($data) {
                return $data->date->format('Y-F');
            })->map(function ($entry) {
                return [
                    'time' => $entry->sum('time'),
                ];
            })->toArray()[today()->format('Y-F')]['time'];
        } catch (ErrorException) {
            $thisMonthsTime = 0;
        }

        return $thisMonthsTime;
    }

    public function bestWeeksTime()
    {
        try {
            $bestWeeksTime = max($this->dailyTimes()->orderBy('date', 'desc')->get()->groupBy(function ($data) {
                return $data->date->format('Y-W');
            })->map(function ($entry) {
                return [
                    'time' => $entry->sum('time'),
                ];
            })->toArray())['time'];
        } catch (ErrorException) {
            $bestWeeksTime = 0;
        }
        return $bestWeeksTime;
    }

    public function vsLastWeekPercentage()
    {
        $weeklyTimes = $this->dailyTimes()->orderBy('date', 'desc')->get()->groupBy(function ($data) {
            return $data->date->format('Y-W');
        })->map(function ($entry) {
            return [
                'time' => $entry->sum('time'),
            ];
        })->toArray();


        try {
            $weeklyChange = ($weeklyTimes[today()->format('Y-W')]['time'] - $weeklyTimes[today()->addDays(-7)->format('Y-W')]['time']) * 100 / $weeklyTimes[today()->addDays(-7)->format('Y-W')]['time'];
        } catch (DivisionByZeroError) {
            $weeklyChange = "∞";
        } catch (ErrorException) {
            $weeklyChange = "∞";
        }
        return $weeklyChange;

    }
}
