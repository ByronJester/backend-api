<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Departments\DepartmentRepositoryInterface; 

class DepartmentController extends Controller
{
    private $repository;

    public function __construct(DepartmentRepositoryInterface $repository)
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
        $data = $request->except(['id']);

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
    
    public function sendMessage(Request $request)
    {
        $contacts = $request->contacts;
        
        foreach($contacts as $contact) {
            $this->repository->sendMessage($contact, $request->message); 
        }

        return response()->json('Successful', 200);
    }
}
