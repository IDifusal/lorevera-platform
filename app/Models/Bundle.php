<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'subtitle', 'normal_price', 'sale_price'];

    /**
     * The programs that belong to the bundle.
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'bundle_program');
    }    
}
