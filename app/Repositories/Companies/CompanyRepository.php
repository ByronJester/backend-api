<?php

namespace App\Repositories\Companies;

use App\Models\Company;
use App\Repositories\Base\Repository; 

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function getById($id)    {
        return $this->model->where('id', $id)->first();
    }

    public function createData($data)
    {
        return $this->model->forceCreate($data);
    }

    public function updateById($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->model->whereIn('id', $id)->delete();
    }
}