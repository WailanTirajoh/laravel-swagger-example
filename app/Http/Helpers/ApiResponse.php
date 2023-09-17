<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponse
{
    public static function success(
        $message = "Success",
        $data = null,
        $statusCode = Response::HTTP_OK
    ) {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }

    public static function error(
        $message = "Something went wrong",
        $data = null,
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {
        return response()->json(['error' => $message, $data => $data], $statusCode);
    }
}
