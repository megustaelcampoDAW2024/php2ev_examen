<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    protected $table = 'paises';
    protected $guarded = [];

    /**
     * Get the clientes for the Pais.
     *
     * @return HasMany
     */
    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'pais_id', 'id');
    }

    /**
     * Get all Paises.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPaises()
    {
        return Pais::all();
    }
}
