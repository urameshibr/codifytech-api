<?php

namespace App\Repositories;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /** Set model INSTANCE for repository
     * @param Model $model
     * @return BaseRepository
     */
    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }


    /** * Get a new clean QUERY BUILDER INSTANCE for repository
     * @return Builder
     */
    public function getNewQuery(): Builder
    {
        return $this->model->newQuery();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->getNewQuery()->paginate(
            request('per_page', 10)
        );
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function find(string|int $id, array $relations = []): ?Model
    {
        $row = $this->model->find($id);

        if (!empty($row) && !empty($relations)) {
            $row->load($relations);
        }

        return $row;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int|string|Model $row, array $data): ?Model
    {
        if ($row instanceof Model) {
            $row->update($data);

            return $row;
        }

        $register = $this->find($row);
        if (!empty($register)) {
            $register->update($data);
        }

        return $register;
    }

    public function destroy(int|string|Model $row): void
    {
        if ($row instanceof Model) {
            $row->delete();

            return;
        }

        $register = $this->find($row);
        if (!empty($register)) {
            $register->delete();
        }
    }
}
