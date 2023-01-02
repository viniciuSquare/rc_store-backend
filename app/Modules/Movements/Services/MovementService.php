<?php

namespace App\Modules\Movements\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\Movement;
use App\Modules\Products\Services\ProductService;
use Illuminate\Support\Facades\DB;

class MovementService extends BaseService
{
  public function __construct()
  {
    $this->setModel(new Movement());
  }

  public function store(array $data)
  {
    try {
      DB::beginTransaction();
      $movement = $this->model
        ->create($data);

      DB::commit();
    } catch (\Throwable $th) {
      throw $th;
    }

    return $movement;
  }

  public function getMovementsByType(int $typeId)
  {
    try {
      DB::beginTransaction();
      $movements = $this->model
        ->where('movement_type_id', $typeId);
    } catch (\Throwable $th) {
      throw $th;
    }

    return $movements;
  }
}
