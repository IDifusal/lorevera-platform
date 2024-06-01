<?php

namespace App\Models;

use App\Models\Day;
use App\Models\ProgramWeek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'featured_image', 'is_public', 'has_access',
        'focus_image_url', 'based_image_url', 'duration_per_workout',
        'duration_per_week', 'focus', 'based', 'overview'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'has_access' => 'boolean',
    ];

    public function weeks()
    {
        return $this->hasMany(ProgramWeek::class);
    }

    public function days()
    {
        // Access all days associated with this program across all weeks
        return $this->hasManyThrough(Day::class, ProgramWeek::class);
    }   
    public function favorites()
    {
        return $this->morphMany(UserFavorite::class, 'favoritable');
    }     
}
