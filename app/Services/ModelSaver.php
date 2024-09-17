<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ModelSaver
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Save data in model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function save(Model $model, array $data): Model
    {
        return $this->repository->save($model, $data);
    }
}

