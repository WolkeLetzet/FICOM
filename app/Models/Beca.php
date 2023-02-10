<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    protected $table = 'becas';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'descuento'
    ];

    public function estudiantes(): HasMany {
        return $this->hasMany(Estudiante::class);
    }
}
