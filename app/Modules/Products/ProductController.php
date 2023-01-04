<?php

namespace App\Modules\Products;

use App\Http\Controllers\Controller;
use App\Modules\Movements\Movement;
use App\Modules\Products\Services\ProductCategoryService;
use App\Modules\Products\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function __construct(
    ProductService $service,
    ProductCategoryService $productCategoryService
  ) {
    $this->service = $service;
    $this->productCategoryService = $productCategoryService;
  }

  function getStock( )
  {
    return response()->json([
      'data' => $this->service->getStock()
    ]);
  }

  function storeProductMovement(Request $request)
  {
    return response()->json([
      "data" => $this->service->storeProductMovement(new Movement($request->toArray()))
    ]);
  }

  public function getCategories()
  {
    return response()->json([
      'data' => $this->productCategoryService->get()
    ]);
  }

  public function storeCategory(Request $request)
  {
    return response()->json([
      $this->productCategoryService->store($request->toArray())
    ]);
  }

  public function deleteCategory(int $id) {
    return response()->json([
      $this->productCategoryService->destroy($id)
    ]);
  }
}
