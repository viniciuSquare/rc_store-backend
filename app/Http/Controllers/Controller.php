<?php

namespace App\Http\Controllers;

use App\Modules\Base\BaseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public BaseService $service;

    public function setService(BaseService $service)
    {
        $this->service = $service;
    }

    public function get()
    {
        return response()->json([
            'data' => $this->service->get()
        ]);
    }

    public function getById(string $id)
    {
        return response()->json([
            'data' => $this->service->getById($id)
        ]);
    }

    public function store(Request $resquest)
    {
        $this->service->store($resquest->toArray());
    }

    public function update(Request $resquest, string $id)
    {
        $this->service->update($resquest->toArray(), $id);
    }
}
