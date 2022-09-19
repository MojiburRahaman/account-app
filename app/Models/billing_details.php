<?php

namespace App\Models;
// namespace Devfaysal\BangladeshGeocode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Database\Eloquent\SoftDeletes;

class billing_details extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded =[];
    function Order_Summaries(){
        return $this->hasMany(Order_Summaries::class, 'billing_details_id');
    }
    function District(){
        return $this->belongsTo(District::class, 'district_name');
    }
    function Division(){
        return $this->belongsTo(Division::class, 'division_name');
    }
    function Upazila(){
        return $this->belongsTo(Upazila::class, 'upozila_name');
    }
}
