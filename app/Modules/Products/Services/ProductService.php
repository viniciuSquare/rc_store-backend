<?php

namespace App\Modules\Products\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\Movement;
use App\Modules\Movements\Services\MovementService;
use App\Modules\Products\Resources\ProductResource;
use App\Modules\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class ProductService extends BaseService
{

  protected Product $model;

  public function __construct()
  {
    $this->setModel(new Product());
    $this->setResource(ProductResource::class);
  }

  public function get(int $id = null)
  {
    return isset($id) ?
      [new ProductResource($this->model->findOrFail($id))]
      :
      ProductResource::collection($this->model->all());
  }

  public function getStock()
  {
    return ProductResource::collection($this->model->where("stock", "!=", 0)->get());
  }

  /**
   * Store product and create movement if current stock is defined
   * */
  function store(array $data)
  {
    try {
      DB::beginTransaction();
      $model = $this->model->create($data);
      $model->cost_price = isset($data["cost_price"]) ? $data["cost_price"] : null;

      if ($data['stock']) {
        $creationMovementTypeId = 1;

        $this->storeProductMovement($model, $model->stock, $creationMovementTypeId);
      }
      DB::commit();
      return new ProductResource($model);
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }

    return $model;
  }

  function storeProductMovement(Movement $movement)
  {
    try {
      DB::beginTransaction();
      $product = $this->model->findOrFail($movement->product_id);

      $movementService = app()->make(MovementService::class);
      $movement = $movementService->store($movement->toArray());

      // Update product stock
      // TODO - If on operator determine calc operation
      $product->stock = $movement->previous_stock + $movement->quantity;
      $product->save();

      DB::commit();
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

    return new ProductResource($product);
  }
}
