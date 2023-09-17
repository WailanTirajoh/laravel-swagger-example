<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{

    /**
     * @OA\Schema(
     *     schema="MovieResource",
     *     title="Movie Resource",
     *     description="Movie Resource",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="The unique identifier of the movie"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="The name of the movie"
     *     ),
     *     @OA\Property(
     *         property="title",
     *         type="string",
     *         description="The title of the movie"
     *     ),
     *     @OA\Property(
     *         property="author",
     *         type="string",
     *         description="The author of the movie"
     *     ),
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'author' => $this->author,
        ];
    }
}
