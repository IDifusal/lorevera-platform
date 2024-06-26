<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'email', 'phone', 'message']; // Allow mass assignment
    public function user()
{
    return $this->belongsTo('App\Models\User', 'user_id');
}
}
