<?php

namespace Database\Seeders;

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
        $this->call([
            NavigationSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            ManufactuerSeeder::class,
            MaterialSeeder::class,
            RoleSeeder::class,
            TransporterSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            ImagesSeeder::class
        ]);
    }
}
