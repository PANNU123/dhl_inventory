<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'sap_vendor_code' => '123456',
            'get_vendor_code' => '1253125',
            'vendor_name' =>  'sajjad',
            'vendor_address'=>'Home# 30,Road# 3, Mirpur-12,Dhaka-1216,Bangladesh',
            'contact_person_name'=>'kabir',
            'contact_number'=>'1796234234',
            'contact_email'=>'superadmin@gmail.com',
        ]);
    }
}
