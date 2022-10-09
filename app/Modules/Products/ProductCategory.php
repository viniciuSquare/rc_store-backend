<?php

namespace App\Modules\Products;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'father_category_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function fatherCategory()
    {
        return $this->hasMany(ProductCategory::class, 'father_category_id');
    }
}
