<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'rut',
        'dv',
        'es_nuevo',
        'curso_id',
        'apoderado_id',
        'prioridad',
        'email_institucional',
        'telefono',
        'direccion'
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
    /**
     * Get the curso that owns the Estudiante
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }
    /**
     * Get all of the pagos for the Estudiante
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
    public function scopeSearchByName($query,$text)
    {
        if($text) $query->orWhere('nombres','LIKE',"%$text%");
    }

    public function scopeSearchBySurname($query,$text)
    {
        if($text) $query->orWhere('apellidos','LIKE',"%$text%");
    }
}
