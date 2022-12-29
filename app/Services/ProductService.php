<?php
namespace App\Services;

use App\Product;
use App\Modules\Base\BaseService;
use Ramsey\Uuid\Type\Integer;

class ProductService extends BaseService
{

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->setModel(Product::class);

    }

    public function getProducts()
    {
        return Product::with('category')->get();
    }

    // public function getById(Integer $productId): Product
    // {
    //     return Product::find($productId);
    // }

}
