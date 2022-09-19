<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function Bank()
    {
        return $this->belongsTo(Bank::class, 'bank_name');
    }
}
