<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','status'
    ];
    public function categorywiseuser(){
        return $this->belongsToMany(User::class,'categories_wise_user');
    }

}
