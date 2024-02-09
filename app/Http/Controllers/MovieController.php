<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Repositories\MovieRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $movies = $this->movieRepository->findAll();

        return MovieResource::collection($movies);
    }

    public function show(int $movieId): MovieResource
    {
        $movie = $this->movieRepository->findOrFail($movieId);

        return new MovieResource($movie);

    }

    public function store(MovieRequest $request): MovieResource
    {
        $movie = $this->movieRepository->store((array)$request->validated());

        return new MovieResource($movie);
    }

    public function update(MovieRequest $request, int $departmentId): JsonResponse
    {
        $this->movieRepository->update((array)$request->validated(), $departmentId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(int $movieId): JsonResponse
    {
        $this->movieRepository->delete($movieId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
