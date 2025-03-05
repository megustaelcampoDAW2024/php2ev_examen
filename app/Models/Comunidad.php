<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comunidad extends Model
{
    protected $table = 'tbl_comunidadesautonomas';
    protected $guarded = [];

    /**
     * Get the provincias for the Comunidad.
     *
     * @return HasMany
     */
    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class, 'comunidad_id', 'id');
    }
}
