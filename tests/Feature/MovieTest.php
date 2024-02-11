<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_storing_movies(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];

        $response = $this->insertMovie($movie);
        $response->assertStatus(201);
    }

    public function test_sorting_movies(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];

        $this->insertMovie($movie);

        $movie2 = [
            'title' => 'Titanic2',
            'director' => 'Director 2',
            'cast' => 'Cast 2',
            'category' => 'Romantic',
            'releaseDate' => '2020-01-01'
        ];

        $this->insertMovie($movie2);

        $movies = $this->get('api/movies?sort=asc');
        self::assertEquals('Titanic', $movies['data'][0]['title']);
        $movies = $this->get('api/movies?sort=desc');
        self::assertEquals('Titanic2', $movies['data'][0]['title']);
    }

    public function test_getting_a_specific_movie(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];

        $response = $this->insertMovie($movie);
        self::assertEquals('Titanic', json_decode($response->getContent())->data->title);
    }

    public function test_updating_a_movie(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];
        $this->insertMovie($movie);

        $newData = [
            'title' => 'Titanic4',
            'director' => 'Director 4',
            'cast' => 'Cast 4',
            'category' => 'Romantic',
            'releaseDate' => '2020-01-01'
        ];

        $this->put('/api/movies/5', $newData);
        $updatedMovie = $this->get('/api/movies/5');

        self::assertNotEquals('Titanic', json_decode($updatedMovie->getContent())->data->title);
        self::assertEquals('Titanic4', json_decode($updatedMovie->getContent())->data->title);
    }

    public function test_if_search_works(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];
        $this->insertMovie($movie);

        $search = $this->get('/api/search?search=ererer');
        $searchTitle = $this->get('/api/search?search=Titanic');
        $searchDirector = $this->get('/api/search?search=Director 1');
        $searchGenre = $this->get('/api/search?search=Romantic');

        self::assertCount(0, json_decode($search->getContent()));
        self::assertCount(1, json_decode($searchTitle->getContent()));
        self::assertCount(1, json_decode($searchDirector->getContent()));
        self::assertCount(1, json_decode($searchGenre->getContent()));
    }

    public function test_if_delete_works(): void
    {
        $movie = [
            'title' => 'Titanic',
            'director' => 'Director 1',
            'cast' => 'Cast 1',
            'category' => 'Romantic',
            'releaseDate' => '2000-01-01'
        ];
        $this->insertMovie($movie);
        $getMovie = $this->get('/api/movies/7');
        $getMovie->assertStatus(200);

        $delete = $this->delete('/api/movies/7');
        $delete->assertStatus(204);

        $getMovie = $this->get('/api/movies/7');
        self::assertNull(json_decode($getMovie->getContent()));
    }

    private function insertMovie(array $data): TestResponse
    {
        return $this->post('/api/movies', $data);
    }
}
