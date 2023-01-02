<?php

namespace App\Modules\Movements\Services;

use App\Modules\Base\BaseService;
use App\Modules\Movements\MovementType;
use App\Modules\Movements\Resources\MovementTypeResource;

class MovementTypeService extends BaseService
{
    protected MovementType $model;

    public function __construct()
    {
        $this->setModel(new MovementType());
    }

    function get(int $id = null)
    {
        return isset($id)
            ? [new MovementTypeResource($this->model->findOrFail($id))]
            : MovementTypeResource::collection($this->model->get());
    }

    function getByOperator(int $operator)
    {
        return MovementTypeResource::collection($this->model->where('operator', $operator)->get());
    }

}
