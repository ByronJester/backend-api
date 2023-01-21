<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\Base\Repository;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $auth = Auth::user();

        return $this->model->where('id', '!=', $auth->id)->where('role', '!=', 1)->get();
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