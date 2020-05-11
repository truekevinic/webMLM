<?php

namespace App\Rules;

use App\PriceList;
use Illuminate\Contracts\Validation\Rule;

class BuyPinRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($registration, $activation)
    {
        $this->registration = $registration;
        $this->activation = $activation;
    }

    public $registration;
    public $activation;
    public $message;


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pinPrice = PriceList::where('name','=','pin')->first()->price;
        if (($pinPrice*$value) != ($this->registration+$this->activation)) {
            $this->message = 'If you buy '.$value.' pin(s), then you should pay '.($pinPrice*$value);
            return false;
        }
        if ($this->activation > (0.3*($pinPrice*$value))) {
            $this->message = 'You cannot use Activation Point more than 30%';
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
