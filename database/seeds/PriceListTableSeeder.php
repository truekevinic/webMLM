<?php

use Illuminate\Database\Seeder;

class PriceListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_lists')->insert([
            'name' => 'pin',
            'price' => 10
        ]);
    }
}
