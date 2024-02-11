<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    const RELEASE_DATE = 'releaseDate';

    const TITLE = 'title';
    const DIRECTOR = 'director';
    const CATEGORY = 'category';

    CONST SEARCH = 'search';

    const SORT = 'sort';

    const ASC = 'asc';
    const DESC = 'desc';

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'director',
        'cast',
        'category',
        'releaseDate',
        'type'
    ];
}
