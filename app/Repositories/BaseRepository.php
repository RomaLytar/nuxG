<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /**
     * Save data in model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function save(Model $model, array $data): Model
    {
        $model->fill($data);
        $model->save();
        return $model;
    }
}
