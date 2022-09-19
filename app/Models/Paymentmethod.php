<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Paymentmethod extends Model
{
    use HasFactory;
    function Bank(){
        return $this->hasMany(Bank::class, 'method_id');
     }
}
