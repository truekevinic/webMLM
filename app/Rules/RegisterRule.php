<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class RegisterRule implements Rule
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
        $user_count = User::where('username','=',$value)->where('active_status','=','active')->count();

        if($user_count==0) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is no existing user to referral';
    }
}
