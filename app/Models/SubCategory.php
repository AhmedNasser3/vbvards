<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subSubCategories()
{
    return $this->hasMany(SubSubCategory::class, 'subcategory_id', 'id');
}

}