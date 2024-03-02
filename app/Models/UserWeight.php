<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeight extends Model
{
    use HasFactory;

    protected $table = 'user_weights'; // Especifica el nombre de la tabla si no sigue la convención de nombres de Laravel

    protected $fillable = ['user_id', 'date', 'weight']; // Especifica los campos que se pueden asignar masivamente

    // Aquí puedes definir cualquier relación, si es necesario
}