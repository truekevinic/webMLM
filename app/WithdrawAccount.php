<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WithdrawAccount extends Model
{
    protected $fillable = ['user_id', 'type', 'balance'];
}
