<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cliente;

class Cuota extends Model
{
    protected $table = 'cuota';
    protected $guarded = [];

    /**
     * Get the cliente that owns the Cuota.
     *
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->withTrashed();
    }

    /**
     * Get the remesa that owns the Cuota.
     *
     * @return BelongsTo
     */
    public function remesa(): BelongsTo
    {
        return $this->belongsTo(Remesa::class, 'remesa_id', 'id')->withTrashed();
    }

    /**
     * Get Cuotas grouped by Cliente.
     *
     * @return array
     */
    public static function getCuotasGroupedByCliente()
    {
        $cuotas = Cuota::all();
        $groupedCuotas = [];

        foreach ($cuotas as $cuota) {
            $groupedCuotas[$cuota->cliente_id][] = $cuota;
        }

        return $groupedCuotas;
    }

}
