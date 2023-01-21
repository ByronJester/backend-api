<?php

namespace App\Repositories\Base;

interface RepositoryInterface 
{
	/**
     * Get Model Data
     * 
     * @return array
     */
	public function getData();

	/**
     * Get Model First Data using id
     * @param id
     * @return object
     */
	public function getFirst($id);

    /**
     * Create Model Data
     * @param array
     * @return object
     */
	public function createData($data);


    /**
     * Update Model Data using id
     * @param id
     * @param array
     * @return bool
     */
	public function updateData($id, $data);


    /**
     * Delete Model Data using id
     * @param id
     * @return bool
     */
	public function deleteData($id);
}