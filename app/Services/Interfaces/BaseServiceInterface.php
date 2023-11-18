<?php

namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function getAll(array $relations);
    public function getById(string|int $id);
    public function create(array $payload);
    public function update(string|int $id, array $payload);
    public function delete(string|int $id);
    public function paginate(
        array $columns = ['*'],
        array $conditions = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $joins = [],
        array $relations = [],
        array $rawQueries = []
    );
    public function updateByWhereIn(string $whereInField, array $whereIn, array $payload);
    public function createPivot($model, array $payload, string $relation);
    public function forceDeleteByCondition(array $conditions = []);
}
