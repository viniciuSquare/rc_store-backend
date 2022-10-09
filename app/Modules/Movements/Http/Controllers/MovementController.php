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

    public function getTypes()
    {
        return response()->json([
            'data' => $this->typeService->get()
        ]);
    }

    public function storeType(Request $request)
    {
        return response()->json([
            $this->typeService->store($request->toArray())
        ]);
    }
}
