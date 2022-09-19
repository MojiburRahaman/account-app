<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Product extends Model
{
    use HasFactory, HasEagerLimit;
    protected $casts = [
        'most_view' => 'integer',
    ];
    function Catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
    function Subcatagory()
    {
        return $this->belongsTo(Subcatagory::class, 'catagory_id');
    }
    function WithTrash_Attribute()
    {
        return $this->hasMany(Attribute::class, 'product_id')->withTrashed();
    }
    function Attribute()
    {
        return $this->hasMany(Attribute::class, 'product_id');
    }
    function Gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }
    function BestDealProduct()
    {
        return $this->hasMany(BestDealProduct::class, 'product_id');
    }
    function Flavour()
    {
        return $this->hasMany(Flavour::class, 'product_id');
    }
    function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    function Banner()
    {
        return $this->hasMany(Banner::class, 'product_id');
    }
    function ProductReview()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
