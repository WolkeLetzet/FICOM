<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nivel',
        'grado',
        'paralelo',
    ];
    /**
     * Get all of the estudiantes for the Curso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
