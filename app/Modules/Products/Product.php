<?php

namespace App\Modules\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'product_category_id',
        'sale_price',
        'stock'
    ];

    public function productCategories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
