<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function create(array $payload = []);
    public function update(int $id = 0, array $payload = []);
    public function all();
    public function findById(int $id);
    public function delete(int $id = 0);
    public function pagination(array $column = ['*'], array $condition = [],  array $join = [] , array $extend = [] , int $perpage , array $relations = []);
    public function updateBywhereIn(array $id = [], array $payload = []);

}
