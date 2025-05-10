<?php

namespace App\Models;

use App\Models\ShipDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipDistricts extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    }

}
