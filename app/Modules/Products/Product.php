<?php

namespace App\Modules\Products;

use App\Modules\Movements\Movement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'product_category_id',
        'sale_price',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function movements()
    {
        return $this->belongsTo(Movement::class);
    }
}
