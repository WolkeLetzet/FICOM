<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';
    
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'genero',
        'rut',
        'dv',
        'prioridad',
        'email_institucional',
        'telefono',
        'direccion',
        'es_nuevo',
        'curso_id',
        'apoderado_id',
        'apoderado_suplente_id'
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

    public function apoderados(): BelongsToMany
    {
        return $this->belongsToMany(Apoderado::class, 'apoderado_estudiante', 'apoderado_id', 'estudiante_id')->withPivot('es_suplente');
    }

    public function apoderadoTitular() {
        return $this->apoderados()->wherePivot('es_suplente', false);
    }

    public function apoderadoSuplente() {
        return $this->apoderados()->wherePivot('es_suplente', true);
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

    public function pagosPorAnio($anio) {
        $pagos_anio = $this->pagos()->where('anio', $anio)->oldest()->get();

        return [
            'matricula' => $pagos_anio->where('mes', 'matricula'),
            'marzo' => $pagos_anio->where('mes', 'marzo'),
            'abril' => $pagos_anio->where('mes', 'abril'),
            'mayo' => $pagos_anio->where('mes', 'mayo'),
            'junio' => $pagos_anio->where('mes', 'junio'),
            'julio' => $pagos_anio->where('mes', 'julio'),
            'agosto' => $pagos_anio->where('mes', 'agosto'),
            'septiembre' => $pagos_anio->where('mes', 'septiembre'),
            'octubre' => $pagos_anio->where('mes', 'octubre'),
            'noviembre' => $pagos_anio->where('mes', 'noviembre'),
            'diciembre' => $pagos_anio->where('mes', 'diciembre')
        ];
    }

    public function scopeSearchByName($query, $text)
    {
        if($text) $query->orWhere('nombres', 'LIKE', "%$text%");
    }

    public function scopeSearchBySurname($query, $text)
    {
        if($text) $query->orWhere('apellidos', 'LIKE', "%$text%");
    }

    public function scopeSearchByRut($query, $text) {
        if($text) $query->orWhere('rut', 'LIKE', "%$text%");
    }
}
