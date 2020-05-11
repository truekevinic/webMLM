<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert([
            'user_id' => 1,
            'account_number' => '1234567890',
            'bank_name' => 'BCA'
        ]);
    }
}
