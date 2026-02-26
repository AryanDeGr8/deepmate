<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTime extends Model
{
    /** @use HasFactory<\Database\Factories\DailyTimeFactory> */
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'date' => 'date:m/d/Y',
        ];
    }

    public function user()
    {
        $this->belongsTo(User::class);

    }
}
