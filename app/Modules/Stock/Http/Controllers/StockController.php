<?php

use App\Http\Controllers\Controller;
use App\Modules\Stock\Services\StockService;

class StockController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(
        StockService $service
    )
    {
        $this->service = $service;
    }

    public function getProductStock(int $productId)
    {
        return response()->json([
            'data' => $this->service->getProductStock($productId)
        ]);
    }
}
