<?php

namespace App\Modules\Movements\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\Movement;

class MovementService extends BaseService
{
    public function __construct()
    {
        $this->setModel(new Movement());
    }

    public function getIncomes()
    {
        return Movement::where('operator', 1);
    }
}
