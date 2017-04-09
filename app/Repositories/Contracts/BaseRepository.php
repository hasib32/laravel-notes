<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    /**
     * Find a resource by id
     *
     * @param $id
     * @return mixed
     */
    public function findOne($id);

    /**
     * Find a resource by criteria
     *
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria);

    /**
     * Search All resources
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findBy(array $searchCriteria = []);

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @return mixed
     */
    public function findIn($key, array $values);

    /**
     * Save a resource
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * Update a resource
     *
     * @param $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data);

    /**
     * delete a resource
     *
     * @param $model
     * @return mixed
     */
    public function delete($model);
}
