<?php
namespace App\Containers\Onboarding\Client\Policies\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidKTPName implements ValidationRule
{
        /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check for numbers or symbols
        if (preg_match('/[^a-zA-Z\s]/', $value)) {
            $fail('Nama tidak valid. Nama tidak boleh mengandung angka, simbol.');
        }

        // Check for prohibited words
        foreach (config("onboarding-client.rules.ValidKTPName.ProhibitedWords") as $word) {
            if (stripos($value, $word) !== false) {
                $fail('Nama tidak valid. Nama tidak boleh mengandung angka, simbol, atau gelar seperti Profesor, Haji, dll.');
            }
        }

    }
}