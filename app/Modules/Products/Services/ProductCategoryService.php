<?php

namespace App\Modules\Products\Services;

use App\Modules\Base\BaseService;
use App\Modules\Products\ProductCategory;
use App\Modules\Products\Resources\ProductCategoryResource;

class ProductCategoryService extends BaseService
{

  protected $model;

  public function __construct()
  {
    $this->setModel(new ProductCategory());
  }

  public function get(int $id = null)
  {
    return ProductCategoryResource::collection($this->model->get());
  }
}
