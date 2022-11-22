<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mes',
        'documento',
        'num_documento',
        'fecha',
        'valor',
        'forma',
        'observacion',
        'estudiante_id'
    ];
}
