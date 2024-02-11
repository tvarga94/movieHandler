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

    /**
     * @OA\Get (
     *     path="/api/movies",
     *     tags={"Movies"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="director",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="cast",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="releaseDate",
     *                         type="string",
     *                      ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $movies = $this->movieRepository->findAll();

        return MovieResource::collection($movies);
    }

    /**
     * @OA\Get (
     *     path="/api/movies/{id}",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number"),
     *              @OA\Property(property="title", type="string"),
     *              @OA\Property(property="director", type="string"),
     *              @OA\Property(property="cast", type="string"),
     *              @OA\Property(property="category", type="string"),
     *              @OA\Property(property="releaseDate", type="string")
     *         )
     *     )
     * )
     */
    public function show(int $movieId): MovieResource
    {
        $movie = $this->movieRepository->findOrFail($movieId);

        return new MovieResource($movie);

    }

    /**
     * @OA\Post (
     *     path="/api/movies",
     *     tags={"Movies"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="director",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="cast",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="category",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="releaseDate",
     *                          type="string"
     *                       ),
     *                 ),
     *                 example={
     *                     "title":"example title",
     *                     "director":"example director",
     *                     "cast":"example cast",
     *                     "category":"example category",
     *                     "releaseDate":"YYYY-MM-DD"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="director", type="string", example="director"),
     *              @OA\Property(property="cast", type="string", example="cast"),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="releaseDate", type="string", example="releaseDate"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function store(MovieRequest $request): MovieResource
    {
        $movie = $this->movieRepository->store((array)$request->validated());

        return new MovieResource($movie);
    }

    /**
     * @OA\Put (
     *     path="/api/movies/{id}",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="director",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="cast",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="category",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="releaseDate",
     *                          type="string"
     *                       )
     *                 ),
     *                 example={
     *                      "title":"example title",
     *                      "director":"example director",
     *                      "cast":"example cast",
     *                      "category":"example category",
     *                      "releaseDate":"YYYY-MM-DD"
     *                 }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="director", type="string", example="director"),
     *              @OA\Property(property="cast", type="string", example="cast"),
     *              @OA\Property(property="category", type="string", example="category"),
     *              @OA\Property(property="releaseDate", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     */
    public function update(MovieRequest $request, int $departmentId): JsonResponse
    {
        $this->movieRepository->update((array)$request->validated(), $departmentId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @OA\Delete (
     *     path="/api/movies/{id}",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="delete movie success")
     *         )
     *     )
     * )
     */
    public function destroy(int $movieId): JsonResponse
    {
        $this->movieRepository->delete($movieId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
