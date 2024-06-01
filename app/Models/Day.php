<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model
{
    use HasFactory;
    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'day_equipment');
    }
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'day_exercise');
    }
    
    // Optionally, if you want to directly access warmups or workouts
    public function warmups()
    {
        return $this->exercises()->where('type', 'warmup');
    }
    
    public function workouts()
    {
        return $this->exercises()->where('type', 'workout');
    }    
    public function favorites()
    {
        return $this->morphMany(UserFavorite::class, 'favoritable');
    }

}
