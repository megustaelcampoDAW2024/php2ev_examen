<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use softDeletes;
    protected $table = 'tareas';
    protected $guarded = [];

    /**
     * Get the operario that owns the Tarea.
     *
     * @return BelongsTo
     */
    public function operario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operario_id', 'id')->withTrashed();
    }

    /**
     * Get the cliente that owns the Tarea.
     *
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->withTrashed();
    }

    /**
     * Get the provincia that owns the Tarea.
     *
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }

    /**
     * Get all Tareas with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getAllTareas()
    {
        return Tarea::paginate(10);
    }

    /**
     * Get Tareas by operario with pagination.
     *
     * @param int $user_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getTareasByOperario($user_id)
    {
        return Tarea::where('operario_id', $user_id)
            ->where('estado', '=', 'P')
            ->paginate(10);
    }
}