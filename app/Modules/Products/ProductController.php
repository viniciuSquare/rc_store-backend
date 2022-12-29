<?php

namespace App\Modules\Products;

use App\Http\Controllers\Controller;
use App\Modules\Products\Resources\ProductResource;
use App\Modules\Products\Services\ProductCategoryService;
use App\Modules\Products\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        ProductService $service,
        ProductCategoryService $productCategoryService
    ) {
        $this->setService($service);
        $this->productCategoryService = $productCategoryService;
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
}
