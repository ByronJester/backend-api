<?php

namespace App\Repositories\Employees;

use App\Models\Employee;
use App\Repositories\Base\Repository;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(Employee $model)
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

    public function sendMessage($contact, $message)
    {
        $ch = curl_init();

        $parameters = array(
            'apikey' => '3763c09ae9280c98876389affa1ad5fc', //Your API KEY
            'number' => $contact,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' ); 
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        //Show the server response
        return $output;
    }
}