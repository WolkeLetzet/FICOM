<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado_Estudiante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'apoderado_id',
        'estudiante_id',
    ];
}
