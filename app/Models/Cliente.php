<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tarea;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $guarded = [];

    /**
     * Set the client's telefono.
     *
     * @param  string  $value
     * @return void
     */
    public function setTelefonoAttribute($value)
    {
        $this->attributes['telefono'] = str_replace([' ', '-'], '', $value);
    }

    /**
     * Get the tareas for the Cliente.
     *
     * @return HasMany
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'cliente_id', 'id');
    }

    /**
     * Get the cuotas for the Cliente.
     *
     * @return HasMany
     */
    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'cliente_id', 'id');
    }

    /**
     * Get the pais that owns the Cliente.
     *
     * @return BelongsTo
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    /**
     * Get all Clientes with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getClientes()
    {
        return Cliente::paginate(10);
    }
}
