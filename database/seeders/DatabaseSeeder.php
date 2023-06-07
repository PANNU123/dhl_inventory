<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(UserTableSeeder::class);
       $this->call(CategoryTableSeeder::class);
       $this->call(RolePermissionTableSeeder::class);
       $this->call(UomTableSeeder::class);
       $this->call(RouteTableSeeder::class);
       $this->call(VendorTableSeeder::class);
       $this->call(SubCategoryTableSeeder::class);
       $this->call(ProductTableSeeder::class);
       $this->call(VehicleTableSeeder::class);

    }
}
