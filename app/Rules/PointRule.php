<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class PointRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param $sum
     */
    public function __construct($sum)
    {
        $this->sum = $sum;
    }

    public $sum;


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $val = (int)(((int)$value)*0.8);
        if ($this->sum != $val) return false;
        else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Point selected must be equal to withdraw gain';
    }
}
