<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $fillable = [
        'id',
        'mes',
        'anio',
        'documento',
        // 'num_documento',
        'fecha_pago',
        'valor',
        'forma',
        'observacion',
        'estudiante_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the estudiante that owns the Pago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }
}
