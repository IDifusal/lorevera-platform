<?php

namespace App\Models;

use App\Models\Day;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercise extends Model
{
    use HasFactory;
    protected $table = 'exercise';
    public function days()
{
    return $this->belongsToMany(Day::class, 'day_exercise');
}
}
