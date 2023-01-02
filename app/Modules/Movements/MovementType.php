<?php

namespace App\Modules\Movements;

use App\Modules\Movements\Movement;
use Illuminate\Database\Eloquent\Model;

class MovementType extends Model
{
    protected $fillable = [
        'name',
        'operator'
    ];

    public function movements()
    {
        return $this->belongsTo(Movement::class, 'movement_type_id');
    }
}
