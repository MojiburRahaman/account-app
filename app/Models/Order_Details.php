<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_Details extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    function Order_Summaries()
    {
        return $this->belongsTo(Order_Summaries::class, 'Order_Summaries_id');
    }
    function Color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    function Size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    function Flavour()
    {
        return $this->belongsTo(Flavour::class, 'flavour_id')->withTrashed();
    }
}
