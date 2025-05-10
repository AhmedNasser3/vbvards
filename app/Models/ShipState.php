<?php

namespace App\Models;

use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    }

     public function district(){
        return $this->belongsTo(ShipDistricts::class,'district_id','id');
    }
}
