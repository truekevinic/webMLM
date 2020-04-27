<?php

use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'package_cost' => 100,
            'max_balance' => 100,
            'max_withdraw' => 2
        ]);
        DB::table('packages')->insert([
            'package_cost' => 300,
            'max_balance' => 300,
            'max_withdraw' => 2
        ]);
        DB::table('packages')->insert([
            'package_cost' => 1000,
            'max_balance' => 1000,
            'max_withdraw' => 2
        ]);
        DB::table('packages')->insert([
            'package_cost' => 3000,
            'max_balance' => 3000,
            'max_withdraw' => 2.5
        ]);
        DB::table('packages')->insert([
            'package_cost' => 5000,
            'max_balance' => 5000,
            'max_withdraw' => 2.5
        ]);
        DB::table('packages')->insert([
            'package_cost' => 10000,
            'max_balance' => 10000,
            'max_withdraw' => 3
        ]);
        DB::table('packages')->insert([
            'package_cost' => 30000,
            'max_balance' => 30000,
            'max_withdraw' => 4
        ]);
    }
}
