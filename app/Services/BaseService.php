<?php

namespace App\Services;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Services\Interfaces\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    protected BaseRepositoryInterface $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $relations = [])
    {
        return $this->repository->all($relations);
    }

    public function getById(string|int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $payload)
    {
        return $this->repository->create($payload);
    }

    public function update(string|int $id, array $payload)
    {
        return $this->repository->update($id, $payload);
    }

    public function delete(string|int $id)
    {
        return $this->repository->delete($id);
    }

    public function paginate(
        array $columns = ['*'],
        array $conditions = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $joins = [],
        array $relations = [],
        array $rawQueries = []
    ) {
        return $this->repository->pagination($columns, $conditions, $perPage, $extend, $orderBy, $joins, $relations, $rawQueries);
    }

    public function updateByWhereIn(string $whereInField, array $whereIn, array $payload)
    {
        return $this->repository->updateByWhereIn($whereInField, $whereIn, $payload);
    }

    public function createPivot($model, array $payload = [], string $relation = '')
    {
        return $this->repository->createPivot($model, $payload, $relation);
    }

    public function forceDeleteByCondition(array $conditions = [])
    {
        return $this->repository->forceDeleteByCondition($conditions);
    }
}
