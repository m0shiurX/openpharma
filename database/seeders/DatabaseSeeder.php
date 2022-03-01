<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CustomerSeeder::class,
            ManufacturerSeeder::class,
            MedicineSeeder::class,
            PurchaseSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
