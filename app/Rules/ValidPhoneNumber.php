<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
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
        // Define the pattern for a valid phone number
        $pattern = '/^\+\d{1,3}(\d{9}|\s\d{9}|\s\d{3}\s\d{3}\s\d{3}|\s\d{3}\s\d{2}\s\d{2}\s\d{2}|\-\d{9}|\-\d{3}\-\d{3}\-\d{3}|\-\d{3}\-\d{2}\-\d{2}\-\d{2})$/';

        // Check if the value matches the pattern
        if (!preg_match($pattern, $value)) {
            $fail('The :attribute must have a valid format, containing only numbers and allowed separator characters.');
        }
    }
}