<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PostResource",
 *     title="Post Resource",
 *     description="Post Resource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the post"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the post"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         description="The slug of the post"
 *     ),
 *     @OA\Property(
 *         property="body",
 *         type="string",
 *         description="The body of the post"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The timestamp when the post was created"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         ref="#/components/schemas/AuthorResource"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The timestamp when the post was last updated"
 *     ),
 * )
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'author' => AuthorResource::make($this->author),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
