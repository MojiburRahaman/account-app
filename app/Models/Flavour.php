<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flavour extends Model
{
    use HasFactory,SoftDeletes;
    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    function Cart()
    {
       return $this->hasMany(Cart::class, 'flavour_id');
    }
    function Wishlist()
    {
       return $this->hasMany(Wishlist::class, 'flavour_id');
    }
    function Order_Details()
    {
       return $this->hasMany(Order_Details::class, 'flavour_id');
    }
}
