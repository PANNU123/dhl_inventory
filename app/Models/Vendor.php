<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'sap_vendor_code','get_vendor_code','vendor_name','vendor_address','contact_person_name','contact_number','contact_email','status',
    ];
}
