<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'sub_category_id',
        'uom_id',
        'name',
        'price',
        'qty',
        'description',
        'slug',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function uom(){
        return $this->belongsTo(Uom::class,'uom_id');
    }
}
