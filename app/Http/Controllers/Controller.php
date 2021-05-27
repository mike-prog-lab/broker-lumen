<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function responseWithError(string $message, int $status = 500): JsonResponse
    {
        return response()->json([
            'error' => $message,
        ], $status ?: 500);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function responseWithMessage(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $status);
    }

    /**
     * @param $entity
     * @param int $status
     * @return JsonResponse
     */
    public function responseWithEntity($entity, int $status = 200): JsonResponse
    {
        return response()->json($entity, $status);
    }
}
