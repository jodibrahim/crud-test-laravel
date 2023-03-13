<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RupiahFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^\d{1,3}(?:\.?\d{3})*(?:,\d{2})?$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Format harga tidak valid.';
    }
}
