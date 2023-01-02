<?php

namespace App\Modules\Movements\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Movements\Services\MovementService;
use App\Modules\Movements\Services\MovementTypeService;

class MovementController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(
        MovementService $service,
        MovementTypeService $typeService
    ) {
        $this->setService($service);
        $this->typeService = $typeService;
    }

    public function getTypes(Request $request)
    {
        $id = $request->query('id', null);

        $operator = $request->query('operator', null);

        if(isset($operator))
        {
            return response()->json([
                'data' => $this->typeService->getByOperator($operator)
            ]);
        }

        return response()->json([
            'data' => $this->typeService->get($id)
        ]);
    }

    public function getMovementsByType(int $typeId)
    {
        return response()->json([
            'data' => $this->service->getMovementsByType($typeId)
        ]);
    }

    public function storeType(Request $request)
    {
        return response()->json([
            $this->typeService->store($request->toArray())
        ]);
    }
}
