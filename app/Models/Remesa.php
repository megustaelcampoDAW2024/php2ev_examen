<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remesa extends Model
{
    use SoftDeletes;
    protected $table = 'remesa';
    protected $guarded = [];

    /**
     * Get the cuotas for the Remesa.
     *
     * @return HasMany
     */
    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'remesa_id', 'id');
    }
}
