<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PackageTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(WalletTypesTableSeeder::class);
        $this->call(WalletsTableSeeder::class);
        $this->call(BonusTypesSeeder::class);
        $this->call(PairingsTableSeeder::class);
        $this->call(BankAccountTableSeeder::class);
        $this->call(PinsTableSeeder::class);
        $this->call(PointTableSeeder::class);
        $this->call(PriceListTableSeeder::class);
    }
}
