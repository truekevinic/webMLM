<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id','wallet_type_id','balance'];

    public function walletTypes(){
        return $this->belongsTo(WalletType::class, 'wallet_type_id');
    }
}
