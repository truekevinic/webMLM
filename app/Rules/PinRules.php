<?php

namespace App\Rules;

use App\Pin;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class PinRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pin = Pin::where('code', '=', $value)->where('status','=','active')->count();

        if ($pin <= 0) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected pin is invalid';
    }
}
