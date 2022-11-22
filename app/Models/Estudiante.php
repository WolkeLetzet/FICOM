<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'run',
        'nivel_id',
        'prioridad',
    ];
}
