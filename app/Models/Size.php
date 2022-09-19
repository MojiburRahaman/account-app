<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Size extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    // use BelongsToThrough;
    function Attribute(){
        return $this->belongsTo(Attribute::class, 'size_id');
    }
    function Product(){
        return $this->belongsToThrough(Product::class, Attribute::class);
    }
}
