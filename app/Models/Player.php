<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $fillable = ['team_id', 'name', 'is_eliminated', 'is_knocked', 'is_in_zone', 'eliminations'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    protected $appends = ['points'];

    public function getPointsAttribute(): int
    {
        $points = 0;

        // alive?
        if (! $this->is_eliminated) {
            $points += 15;
        }

        // eliminations → ×2
        $points += $this->eliminations * 2;

        // knocked penalty
        if ($this->is_knocked) {
            $points -= 2;
        }

        // zone bonus
        if ($this->is_in_zone) {
            $points += 2;
        }

        return $points;
    }
}
