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
            'package_cost' => 50,
            'max_balance' => 500
        ]);
        DB::table('packages')->insert([
            'package_cost' => 100,
            'max_balance' => 1000
        ]);
    }
}
