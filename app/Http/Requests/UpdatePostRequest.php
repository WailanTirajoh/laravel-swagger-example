<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePostRequest",
 *     title="Update Post Request",
 *     description="Request structure for updating a post",
 *     required={"title", "slug", "body", "author_id"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The updated title of the post"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         description="The updated slug of the post"
 *     ),
 *     @OA\Property(
 *         property="body",
 *         type="string",
 *         description="The updated body of the post"
 *     ),
 *     @OA\Property(
 *         property="author_id",
 *         type="integer",
 *         description="The updated user ID associated with the post"
 *     )
 * )
 */
class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string'
            ],
            'slug' => [
                'required',
                'string',
                "unique:posts,slug,{$this->post->id}"
            ],
            'body' => [
                'required',
                'string'
            ],
            'author_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
        ];
    }
}
