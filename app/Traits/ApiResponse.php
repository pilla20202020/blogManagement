<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a standardized success JSON response.
     *
     * @param  mixed       $data     The data payload
     * @param  string|null $message  Optional human-readable message
     * @param  int         $status   HTTP status code (default: 200)
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse(mixed $data, string $message = null, int $status = 200): JsonResponse
    {
        $payload = [
            'success' => true,
            'data'    => $data,
        ];

        if ($message !== null) {
            $payload['message'] = $message;
        }

        return response()->json($payload, $status);
    }

    /**
     * Return a standardized error JSON response.
     *
     * @param  string      $message  Human-readable error message
     * @param  int         $status   HTTP status code (default: 400)
     * @param  mixed|null  $errors   Optional array or object of validation/errors details
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(string $message, int $status = 400, mixed $errors = null): JsonResponse
    {
        $payload = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $status);
    }
}
