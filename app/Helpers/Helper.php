<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

if (!function_exists('success')) {
    function success($message = "", $data = [], $statusCode = 200): JsonResponse
    {
        // Pastikan $message adalah string dan ubah menjadi array jika perlu
        if (!is_array($message)) {
            $message = ['message' => $message];
        }

        // Pastikan $data adalah array
        if (!is_array($data)) {
            $data = ['data' => $data];
        }

        return response()->json(array_merge($message, $data), $statusCode);
    }
}

if (!function_exists('error')) {
    function error($message = "", $statusCode = 400, $error = [], $data = []): JsonResponse
    {
        // Pastikan $message adalah string dan ubah menjadi array jika perlu
        if (!is_array($message)) {
            $message = ['message' => $message];
        }

        // Pastikan $error adalah array
        if (!is_array($error)) {
            $error = ['error' => $error];
        }

        // Pastikan $data adalah array
        if (!is_array($data)) {
            $data = ['data' => $data];
        }

        return response()->json(array_merge($message, $error, $data), $statusCode);
    }
}
