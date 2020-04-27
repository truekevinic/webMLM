<?php

use Illuminate\Database\Seeder;
use App\Pairing;

class PairingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pairings')->insert([
            'group_deposit' => 10000,
            'prize' => 500
        ]);
        DB::table('pairings')->insert([
            'group_deposit' => 30000,
            'prize' => 1000
        ]);
        DB::table('pairings')->insert([
            'group_deposit' => 80000,
            'prize' => 2000
        ]);
        DB::table('pairings')->insert([
            'group_deposit' => 200000,
            'prize' => 5000
        ]);
        DB::table('pairings')->insert([
            'group_deposit' => 500000,
            'prize' => 10000
        ]);
        DB::table('pairings')->insert([
            'group_deposit' => 1000000,
            'prize' => 20000
        ]);
    }
}
