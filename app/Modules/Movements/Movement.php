<?php

namespace App\Modules\Movements;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    protected $fillable = [
        'quantity',
        'cost',
        'description',
        'previous_stock',
        'product_id',
        'supplier_id',
        'movement_type_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function movementType()
    {
        return $this->hasOne(MovementType::class);
    }
}
