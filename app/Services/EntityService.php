<?php


namespace App\Services;


use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntityService
 * @package App\Services
 */
abstract class EntityService
{
    /**
     * @var Repository
     */
    protected Repository $repository;

    /**
     * @param array $data
     * @return Collection
     */
    public function findBy(array $data): Collection
    {
        return $this->repository->findBy($data);
    }

    /**
     * @param array $data
     * @return Model|null
     * @throws \Throwable
     */
    public function create(array $data): ?Model
    {
        return $this->repository->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return bool
     * @throws \Throwable
     */
    public function update(Model $model, array $data): bool
    {
        $model->fill($data);

        return $this->repository->save($model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $this->repository->delete($model);
    }
}
