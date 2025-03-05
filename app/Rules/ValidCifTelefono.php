<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Cliente;

class ValidCifTelefono implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $cif = request()->input('cif');
        $telefono = request()->input('telefono');
        $telefono = str_replace([' ', '-'], '', $telefono);

        return Cliente::where('cif', $cif)->where('telefono', $telefono)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'El CIF y el teléfono no coinciden con ningún cliente.';
    }
}