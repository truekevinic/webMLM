<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet_types')->insert([
            'type_name' => 'direct',
        ]);
        DB::table('wallet_types')->insert([
            'type_name' => 'pairing',
        ]);
        DB::table('wallet_types')->insert([
            'type_name' => 'jackpot',
        ]);
    }
}
