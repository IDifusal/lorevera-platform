<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'scheduled_notifications';
    protected $fillable = ['user_id', 'type', 'status', 'scheduled_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
