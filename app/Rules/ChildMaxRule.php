<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class ChildMaxRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $child_count = User::where('parent_id', '=', $value)->count();

        if ($child_count >= 3) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This user already have maximum child.';
    }
}
