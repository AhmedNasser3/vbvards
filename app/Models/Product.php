<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

      public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'order_id', 'id');
    }
  public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

}
