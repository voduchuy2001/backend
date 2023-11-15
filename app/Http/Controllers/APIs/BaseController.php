<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    public function withSuccess(
        $data = [],
        $message = 'Success',
        $statusCode = Response::HTTP_OK
    ): JsonResponse {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()
            ->json($response, $statusCode);
    }

    public function withError(
        $message = 'Error',
        $statusCode = Response::HTTP_BAD_REQUEST,
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()
            ->json($response, $statusCode);
    }
}
