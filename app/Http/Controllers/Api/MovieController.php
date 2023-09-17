<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Movies",
 *     description="Movies endpoints"
 * )
 */
class MovieController extends Controller
{
    /**
     * Get a list of movies.
     *
     * @OA\Get(
     *     path="/api/movies",
     *     summary="Get a list of movies",
     *     description="Returns a list of movies",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of movies per page (default is 5)",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=5
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Current page (default is 1)",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response: List of movies",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized: Invalid credentials",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden: Insufficient permissions",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found: Movies not found",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit', 5);
        $movies = Movie::paginate($limit);

        return response()->json([
            'movies' => MovieResource::collection($movies)
        ]);
    }

    /**
     * Store a new movie.
     *
     * @OA\Post(
     *     path="/api/movies",
     *     summary="Store a new movie",
     *     description="Stores a new movie in the database",
     *     tags={"Movies"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreMovieRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Movie created successfully"
     *             ),
     *             @OA\Property(
     *                 property="movie",
     *                 ref="#/components/schemas/MovieResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function store(StoreMovieRequest $request)
    {
        $validatedData = $request->validated();
        $movie = Movie::create($validatedData);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => MovieResource::make($movie)
        ], Response::HTTP_CREATED);
    }

    /**
     * Get a single movie by ID.
     *
     * @OA\Get(
     *     path="/api/movies/{movie}",
     *     summary="Get a single movie by ID",
     *     description="Retrieves a single movie by its ID",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="movie",
     *         in="path",
     *         required=true,
     *         description="ID of the movie to retrieve",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="movie",
     *                 ref="#/components/schemas/MovieResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function show(Movie $movie)
    {
        return response()->json([
            'movie' => MovieResource::make($movie)
        ]);
    }

    /**
     * Update a movie by ID.
     *
     * @OA\Put(
     *     path="/api/movies/{movie}",
     *     summary="Update a movie by ID",
     *     description="Updates a movie by its ID",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="movie",
     *         in="path",
     *         required=true,
     *         description="ID of the movie to update",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateMovieRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Movie updated successfully"
     *             ),
     *             @OA\Property(
     *                 property="movie",
     *                 ref="#/components/schemas/MovieResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return response()->json([
            'message' => 'Movie updated successfully',
            'movie' => MovieResource::make($movie)
        ], Response::HTTP_OK);
    }

    /**
     * Delete a movie by ID.
     *
     * @OA\Delete(
     *     path="/api/movies/{movie}",
     *     summary="Delete a movie by ID",
     *     description="Deletes a movie by its ID",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="movie",
     *         in="path",
     *         required=true,
     *         description="ID of the movie to delete",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Movie deleted successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     *
     * )
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully',
        ], Response::HTTP_OK);
    }
}
