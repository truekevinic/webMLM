<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bonus_types')->insert([
            'bonus_type_name' => 'direct'
        ]);
        DB::table('bonus_types')->insert([
            'bonus_type_name' => 'pairing'
        ]);
        DB::table('bonus_types')->insert([
            'bonus_type_name' => 'jackpot'
        ]);
    }
}
