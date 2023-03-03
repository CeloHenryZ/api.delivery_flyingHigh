<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validatorMoney implements Rule
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
        return preg_match("^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$^", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'digíte um valor válido';
    }
}
