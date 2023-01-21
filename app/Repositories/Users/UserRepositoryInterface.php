<?php

namespace App\Repositories\Users;

use App\Repositories\Base\RepositoryInterface;

interface UserRepositoryInterface
{
    /**
     * ALL MODEL DATA
     * 
     * @return array
     */
	public function all();

	/**
     * GET MODEL DATA BY ID
     * @param id
     * @return object
     */
	public function getById($id);

    /**
     * CREATE MODEL DATA
     * @param array
     * @return object
     */
	public function createData($data);


    /**
     * UPDATE MODEL DATA BY ID
     * @param id
     * @param array
     * @return bool
     */
	public function updateById($id, $data);


    /**
     * DELETE MODEL DATA BY ID
     * @param id
     * @return bool
     */
	public function deleteById($id);
}