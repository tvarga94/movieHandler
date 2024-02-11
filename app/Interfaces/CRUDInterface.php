<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CRUDInterface
{
    public function findAll(?string $sort): Collection;

    public function findOrFail(int $id): Model;

    public function store(array $data): Model;

    public function update(array $data, int $id): void;

    public function delete(int $id): void;
}
