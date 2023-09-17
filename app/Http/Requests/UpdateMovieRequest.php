<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateMovieRequest",
 *     title="Update Movie Request",
 *     description="Request structure for storing a new movie",
 *     required={"name", "title", "author"},
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
 *     )
 * )
 */
class UpdateMovieRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'title' => [
                'required',
                'string'
            ],
            'author' => [
                'required',
                'string'
            ],
        ];
    }
}
