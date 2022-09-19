<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcatagory extends Model
{
    use HasFactory;
    function Catagory(){
      return  $this->belongsTo(Catagory::class, 'catagory_id');
    }
}
