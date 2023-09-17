<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StorePostRequest",
 *     title="Store Post Request",
 *     description="Request structure for storing a new post",
 *     required={"title", "slug", "body", "author_id"},
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
 *         property="author_id",
 *         type="integer",
 *         description="The updated user ID associated with the post"
 *     )
 * )
 */
class StorePostRequest extends FormRequest
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
                'unique:posts,slug'
            ],
            'body' => [
                'required',
                'string'
            ],
            'author_id' => [
                'required',
                'integer',
                'exists:users,id'
            ]
        ];
    }
}
