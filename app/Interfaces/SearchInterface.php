<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SearchInterface
{
    public function search(string $search): Collection;
}
