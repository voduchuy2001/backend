<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $relations = [])
    {
        return $this->model->with($relations)->get();
    }

    public function findById(string|int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $payload)
    {
        return $this->model->create($payload);
    }

    public function update(string|int $id, array $payload)
    {
        return $this->model->findOrFail($id)->update($payload);
    }

    public function delete(string|int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function pagination(
        array $columns = ['*'],
        array $conditions = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $joins = [],
        array $relations = [],
        array $rawQueries = []
    ) {
        $query = $this->model->select($columns);

        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }

        foreach ($joins as $table => $joinCondition) {
            $query->join($table, ...$joinCondition);
        }

        $query->with($relations);

        foreach ($rawQueries as $rawQuery) {
            $query->whereRaw($rawQuery);
        }

        foreach ($extend as $extension) {
            $query->addSelect($extension);
        }

        $query->orderBy(...$orderBy);

        return $query->paginate($perPage);
    }

    public function updateByWhereIn(string $whereInField, array $whereIn, array $payload)
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function createPivot($model, array $payload, string $relation)
    {
        return $model->{$relation}()->attach($payload);
    }

    public function forceDeleteByCondition(array $conditions)
    {
        return $this->model->where($conditions)->forceDelete();
    }
}
