<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public const RELEASE_DATE = 'releaseDate';

    public const TITLE = 'title';
    public const DIRECTOR = 'director';
    public const CATEGORY = 'category';

    public const SEARCH = 'search';

    public const SORT = 'sort';

    public const ASC = 'asc';
    public const DESC = 'desc';

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
