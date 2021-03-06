<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
            'user_id' => 1,
            'wallet_type_id' => 1,
            'balance' => 0,
            'max_balance' => null,
            'max_withdraw' => null,
            'level' => null
        ]);
        DB::table('wallets')->insert([
            'user_id' => 1,
            'wallet_type_id' => 2,
            'balance' => 0,
            'max_balance' => null,
            'max_withdraw' => null,
            'level' => 1
        ]);
        DB::table('wallets')->insert([
            'user_id' => 1,
            'wallet_type_id' => 3,
            'balance' => 0,
            'max_balance' => null,
            'max_withdraw' => null,
            'level' => null
        ]);
    }
}
