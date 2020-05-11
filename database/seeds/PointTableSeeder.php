<?php

use Illuminate\Database\Seeder;

class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_points')->insert([
            'user_id' => 1,
            'balance' => 0
        ]);
        DB::table('registration_points')->insert([
            'user_id' => 1,
            'balance' => 0
        ]);
        DB::table('activation_points')->insert([
            'user_id' => 1,
            'balance' => 0
        ]);
        DB::table('mcd_points')->insert([
            'user_id' => 1,
            'balance' => 0
        ]);
    }
}
