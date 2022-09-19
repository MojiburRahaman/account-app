<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catagory extends Model
{
    use HasFactory;
    function Subcatagory(){
       return $this->hasMany(Subcatagory::class, 'catagory_id');
    }
    function Product(){
       return $this->hasMany(Product::class, 'catagory_id');
    }
}
