<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'email_institucional',
        'rut',
        'es_nuevo',
        'curso_id',
        'apoderado_id',
        'prioridad'
    ];

    /**
     * Get the apoderado that owns the Estudiante
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apoderado(): BelongsTo
    {
        return $this->belongsTo(Apoderado::class);
    }
}
