<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','vehicle_name','vehicle_cc','vehicle_engine_number','vehicle_chassis_number',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
