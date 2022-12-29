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

    public function get(Request $request)
    {
        $productId = isset($request->query()['id'])
            ? $request->query()['id']
            : null;

        return response()->json([
            'data' => $this->service->get($productId)
        ]);
    }

    public function getById(string $id)
    {
        return response()->json([
            'data' => $this->service->get($id)
        ]);
    }

    public function store(Request $resquest)
    {
        return $this->service->store($resquest->toArray());
    }

    public function update(Request $resquest, string $id)
    {
        $this->service->update($resquest->toArray(), $id);
    }
}
