<?php

namespace App\Repositories;

use App\Traits\FileManagement;
use Illuminate\Database\Eloquent\Model;

class ResourceRepository
{
    use FileManagement;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Default primary key of the model.
     * @var string
     */
    public $primaryKey;

    /**
     * Get the model instance.
     * @return mixed
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByID($id){
        return $this->model->FindOrFail($id);
    }

    /**
     * @param $nbrPerPage
     * @return mixed
     */
    public function getPaginate($nbrPerPage){
        return $this->model->paginate($nbrPerPage);
    }

    public function getPaginateOrdreBy($nbrPerPage, $orderBy)
    {
        return $this->model->orderBy($orderBy, 'DESC')->paginate($nbrPerPage);
    }

    /**
     * @param $model
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Model $model)
    {
        if (defined('static::FILE') && !empty($model[static::FILE]) && !is_null($model[static::FILE]))
            $this->deleteFile($model[static::FILE]);

        return $model->delete();
    }

    /**
     * @param $model
     * @param array $inputs
     * @return mixed
     */
    public function update(Model $model, array $inputs)
    {
        if (defined('static::FILE') && isset($inputs[static::FILE]))
            $inputs[static::FILE] = $this->updateFile($inputs[static::FILE], $model[static::FILE], static::LINK, static::DISK);

        return $model->update($inputs);
    }


    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        if (defined('static::FILE') && isset($inputs[static::FILE]))
            $inputs[static::FILE] = $inputs[static::FILE]->store(static::LINK, static::DISK);

        return $this->model->create($inputs);
    }

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function count(){
        return $this->model->count();
    }

    /**
     * @return mixed
     */
    public function first(){
        return $this->model->first();
    }

}