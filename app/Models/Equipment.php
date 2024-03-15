<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    public function days()
{
    return $this->belongsToMany(Day::class, 'day_equipment');
}
}
