<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\ShipState;
use App\Models\RechargeCard;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

     public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    }

     public function district(){
        return $this->belongsTo(ShipDistricts::class,'district_id','id');
    }

     public function state(){
        return $this->belongsTo(ShipState::class,'state_id','id');
    }
     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function recharge()
    {
        return $this->belongsTo(RechargeCard::class, 'recharge_card_id');
    }

}