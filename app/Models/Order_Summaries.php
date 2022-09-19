<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_Summaries extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    function billing_details()
    {
        return $this->belongsTo(billing_details::class, 'billing_details_id');
    }
    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function Order_Details()
    {
        return $this->hasMany(Order_Details::class, 'Order_Summaries_id');
    }
}
