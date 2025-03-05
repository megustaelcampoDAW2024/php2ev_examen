<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validFechaRealizacion implements ValidationRule
{
    protected $estado;

    /**
     * Constructor.
     *
     * @param string $estado Estado de la tarea.
     */
    public function __construct($estado)
    {
        $this->estado = $estado;
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
        if(!$this->validateFecha($value)){
            $fail('La fecha de Realización debe completarse si la tarea ya se ha realizado');
        }
    }

    /**
     * Validate the date based on the task state.
     *
     * @param mixed $value
     * @return bool
     */
    private function validateFecha($value): bool
    {
        if ($this->estado != 'R' && !empty($value)) {
            return false;
        } 
        if ($this->estado == 'R' && empty($value)) {
            return false;
        }
        return true;
    }
}
