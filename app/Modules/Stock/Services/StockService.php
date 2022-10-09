<?php

namespace App\Modules\Stock\Services;

use App\Modules\Base\BaseService;
use App\Stock;

class StockService extends BaseService
{
    public function __construct()
    {
        $this->setModel(new Stock());
    }

    public function getProductStock(int $productId)
    {
        return Stock::where('product_id', $productId);
    }
}
