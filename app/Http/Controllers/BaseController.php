<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * Success response
     */
    public function sendResponse($data, $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error response
     */
    public function sendError($message, $errors = [], $code = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}