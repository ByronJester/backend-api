<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $res = $this->repository->all(); 

        return response()->json(['data' => $res], 200);
    }

    public function create(Request $request)
    {
        $data = $request->except(['id', 'password']);

        if($password = $request->password) {
            $data['password'] = Hash::make($password);
        }
        
        $res = $this->repository->createData($data);

        return response()->json('Successful', 200);
    }

    public function update(Request $request)
    {
        $data = $request->except(['id']);
        
        $res = $this->repository->updateById($request->id, $data); 
        
        return response()->json('Successful', 200);
    }

    public function delete(Request $request)
    {
        $res = $this->repository->deleteById($request->ids); 

        return response()->json('Successful', 200);
    }
}
