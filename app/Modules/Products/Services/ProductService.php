<?php
namespace App\Modules\Products\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\Services\MovementService;
use App\Modules\Products\Product;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{

    protected $model;

    public function __construct()
    {
        $this->setModel(new Product());

    }

    function store(array $data)
    {
        try {
            DB::beginTransaction();
                $model = $this->model->create($data);

                if($data['current_stock']) {
                    $movementService = new MovementService();
                    $movementService->store([
                        'product_id' => $model->id,
                        
                    ])
                }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


        // return $model;
    }

}
