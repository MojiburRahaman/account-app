<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Attribute extends Model
{
    use HasFactory,HasEagerLimit,SoftDeletes;

    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    function Color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    function Size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    // function Flavour()
    // {
    //     return $this->hasMany(Flavour::class, 'size_id');
    // }
}
