<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AuthorResource",
 *     title="Author Resource",
 *     description="Author Resource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the author"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the author"
 *     ),
 * )
 */
class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}
