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
    }
}
