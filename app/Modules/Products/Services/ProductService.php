<?php
namespace App\Modules\Products\Services;

use App\Modules\Base\BaseService;
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

    /**
     * Store product and create movement if current stock is defined
     * */
    function store(array $data)
    {
        try {
            DB::beginTransaction();
                $model = $this->model->create($data);
                $model->cost_price = isset($data["cost_price"]) ? $data["cost_price"] : null;

                if($data['stock']) {
                    $creationMovementId = 1;

                    $this->createProductMovement($model, $creationMovementId);
                }
            DB::commit();
            return new ProductResource($model);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $model;
    }

    function createProductMovement( Product $product, int $movementId )
    {
        $movementService = new MovementService();
        $movementService->store([
            'product_id'           => $product->id,
            'quantity'             => $product->stock,
            'price'                => $product->cost_price,
            'movement_category_id' => $movementId,
        ]);
    }

}
