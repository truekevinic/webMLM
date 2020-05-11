<?php

use Illuminate\Database\Seeder;

class PinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('pins')->insert([
                'referral_id' => 1,
                'used_id' => 0,
                'code' => strtoupper(substr(uniqid(),-8)),
                'status' => 'active'
            ]);
        }
    }
}
