<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MovieRepository implements CRUDInterface
{
    public function findAll(): Collection
    {
        return Movie::all();
    }

    public function findOrFail(int $id): Model
    {
        return Movie::query()->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return Movie::query()->create($data);
    }

    public function update(array $data, int $id): void
    {
        Movie::query()->findOrFail($id)->update($data);
    }

    public function delete(int $id): void
    {
        $this->findOrFail($id)->delete();
    }
}
