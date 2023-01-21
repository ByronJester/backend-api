<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    private $model;

    public function __construct(?Model $model)
    {
        $this->model = $model;
    }

    public function getData()
    {
        return $this->model->get();
    }

    public function getFirst($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function createData($data)
    {
        return $this->model->forceCreate($data);
    }

    public function updateData($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}