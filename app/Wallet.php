<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id','wallet_type_id','balance','max_balance','max_withdraw','level'];

    public function walletTypes(){
        return $this->hasOne(WalletType::class, 'wallet_type_id', 'wallet_type_id');
    }
}
