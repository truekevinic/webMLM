<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    protected $fillable = ['type_name'];

    public function wallet(){
        return $this->hasMany(Wallet::class);
    }
}
