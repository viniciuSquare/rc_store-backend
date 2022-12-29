<?php

namespace App\Modules\Movements\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\Movement;
use Illuminate\Support\Facades\DB;

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

    public function getMovementsByType(int $typeId)
    {
        try {
            DB::beginTransaction();
            $movements = $this->model->where('movement_category_id', $typeId);

        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }

        return $movements;
    }
}
