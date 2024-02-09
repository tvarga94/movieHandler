<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Xylis\FakerCinema\Provider\Movie as FakerMovie;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'title' => FakerMovie::movie(),
            'director' => $faker->name,
            'cast' => '',
            'category' => FakerMovie::movieGenre(),
            'releaseDate' => $faker->date,
        ];
    }
}
