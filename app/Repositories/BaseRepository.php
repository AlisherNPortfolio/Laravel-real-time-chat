<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        $model = $this->getOne($id);

        return $model->update($attributes);
    }

    public function getOne(int $id, array $relations = [])
    {
        $model = $this->model;
        if (count($relations) > 0) {
            $model = $model->with($relations);
        }

        $model = $model->find($id);

        abort_if(!$model, 404, 'Record not found');

        return $model;
    }

    public function paginate(int $id = 0, int $perPage = 15)
    {
        return $this->model
                    ->where('id', '>=', $id)
                    ->limit($perPage)
                    ->get();
    }

    public function delete(int $id)
    {
        $model = $this->getOne($id);

        return $model->delete();
    }
}
