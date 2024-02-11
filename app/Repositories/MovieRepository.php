<?php

namespace App\Repositories;

use App\Interfaces\CRUDInterface;
use App\Interfaces\SearchInterface;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MovieRepository implements CRUDInterface, SearchInterface
{
    public function findAll(?string $sort): Collection
    {
        return Movie::query()->orderBy(Movie::RELEASE_DATE, $sort)->get();
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

    public function search(string $search): Collection
    {
        return Movie::query()->where(Movie::TITLE, 'LIKE', "%{$search}%")
            ->orWhere(Movie::DIRECTOR, 'LIKE', "%{$search}%")
            ->orWhere(Movie::CATEGORY, 'LIKE', "%{$search}%")
            ->get();
    }
}
