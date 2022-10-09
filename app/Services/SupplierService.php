<?php

use App\Modules\Base\BaseService;
use App\Supplier;
use Ramsey\Uuid\Type\Integer;

class SupplierService extends BaseService
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->setModel(Supplier::class);
    }

    public function getSuppliers()
    {
        return Supplier::all();
    }

    public function getById(Integer $supplierId): Supplier
    {
        return Supplier::findOrFail($supplierId);
    }
}
