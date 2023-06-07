<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'user_id' => 1,
            'vehicle_name' => 'Mahindra',
            'vehicle_cc' => 250,
            'vehicle_engine_number' => '213544548897',
            'vehicle_chassis_number' => '7894645132312',
        ]);
        Vehicle::create([
            'user_id' => 1,
            'vehicle_name' => 'Tata',
            'vehicle_cc' => 300,
            'vehicle_engine_number' => '213561248880',
            'vehicle_chassis_number' => '78946451363254',
        ]);
    }
}
