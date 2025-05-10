<?php

namespace App\Models;

use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class, 'category_id', 'id');
    }

}