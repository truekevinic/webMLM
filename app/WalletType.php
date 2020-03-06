<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    protected $fillable = ['type_name'];

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_type_id', 'wallet_type_id');
    }
}
