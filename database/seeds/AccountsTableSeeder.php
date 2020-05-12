<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'max_bonus' => 60,
            'upgrade_cost' => 0
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 232,
            'upgrade_cost' => 58
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 840,
            'upgrade_cost' => 105
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 336,
            'upgrade_cost' => 210
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 1344,
            'upgrade_cost' => 420
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 5376,
            'upgrade_cost' => 840
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 215040,
            'upgrade_cost' => 1680
        ]);
        DB::table('accounts')->insert([
            'max_bonus' => 860160,
            'upgrade_cost' => 3360
        ]);
    }
}
