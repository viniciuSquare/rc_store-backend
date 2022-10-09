<?php
namespace App\Modules\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

abstract class BaseService
{
    /**
     * Returns service Eloquent model
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Returns service Eloquent model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Define service's JsonResource
     *
     * @param \Illuminate\Http\Resources\Json\JsonResource
     *
     * @return void
     */
    protected function setResource(string $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Returns service's JsonResource
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getResource(Model $model): JsonResource
    {
        if (!isset($this->resource)) {
            throw new \Exception('JsonResource not declared "' . get_class($this) . '".');
        }

        $resource = $this->resource;

        return new $resource($model);
    }

    public function get()
    {
        return $this->model->all();

    }

    public function getCollection()
    {
        return $this->resource->collection($this->model);
    }

    public function getById(string $id)
    {
        return $this->service->getById($id);
    }

    /**
     * Persiste os dados de um modelo a partir dos dados inseridos
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
                $model = $this->model->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $model;
    }

    public function update(array $data, string $id)
    {
        try {
            DB::beginTransaction();
                $model = $this->model->findOrFail($id);
                $model->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $model;
    }

    /**
     * Remove registros do modelo do banco de dados
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $model = $this->model->findOrFail($id);

            $model->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $model;
    }

    /**
     * Restaura registros do modelo do banco de dados
     *
     * @param string $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function restore(string $id)
    {
        try {
            DB::beginTransaction();

            // A função withTrashed trás até os registros
            // removidos com soft delete
            $model = $this->model->withTrashed()->findOrFail($id);

            $model->restore();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $model;
    }
}
