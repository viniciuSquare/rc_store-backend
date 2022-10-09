<?php
namespace App\Modules\Products\Services;

use App\Modules\Base\BaseService;
use App\Modules\Products\ProductCategory;

class ProductCategoryService extends BaseService
{

    protected $model;

    public function __construct()
    {
        $this->setModel(new ProductCategory());

    }

}
