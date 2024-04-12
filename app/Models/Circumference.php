<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circumference extends Model
{
    use HasFactory;
    protected $fillable = ['value', 'type', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);  // Circumference belongs to a User
    }    
}
