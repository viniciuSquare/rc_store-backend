<?php

namespace App\Modules\Movements\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\MovementType;

class MovementTypeService extends BaseService
{
    public function __construct()
    {
        $this->setModel(new MovementType());
    }
}