<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','product_id','route_id','quantity','issue_full_quantity',
        'issue_partial_quantity','issue_balance_quantity','admin_set_quantity','status'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function route(){
        return $this->belongsTo(Route::class,'route_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
