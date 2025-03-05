<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validCodigoPostal implements ValidationRule
{
    protected $provinciaId;

    /**
     * Constructor.
     *
     * @param string $provinciaId ID de la provincia.
     */
    public function __construct($provinciaId)
    {
        $this->provinciaId = $provinciaId;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extract the first two digits of the postal code
        $firstTwoDigits = substr($value, 0, 2);

        // Check if the first two digits match the province ID
        if ($firstTwoDigits != $this->provinciaId) {
            $fail('El Código Postal debe coincidir con la provincia seleccionada.');
        }
    }
}