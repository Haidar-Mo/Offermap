<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

trait LocaleResponseTrait
{
    /**
     * Show a success response with model data.
     *
     * @param mixed $data
     * @param string $messageKey Translation key from messages.php
     * @param array $replace Placeholder replacements
     * @param int $status
     * @return JsonResponse
     */
    public function showResponse(
        $data,
        string $messageKey = 'api.success',
        array $replace = [],
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => __("messages.$messageKey", $replace),
            'data' => $data,
        ], $status);
    }

    /**
     * Show an error response with exception message.
     *
     * @param \Exception $exception
     * @param string $messageKey Translation key from messages.php
     * @param array $replace Placeholder replacements
     * @return JsonResponse
     */
    public function showError(
        \Exception $exception,
        string $messageKey = 'api.error',
        array $replace = []
    ): JsonResponse {
        Log::error('Error occurred: ' . $exception->getMessage());

        $statusCode = $exception->getCode();
        $validStatus = array_key_exists($statusCode, Response::$statusTexts)
            ? $statusCode
            : Response::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json([
            'success' => false,
            'message' => __("messages.$messageKey", $replace),
            'error' => $exception->getMessage(),
        ], $validStatus);
    }

    /**
     * Show a general message response.
     *
     * @param string $messageKey Translation key from messages.php
     * @param array $replace Placeholder replacements
     * @param int $status
     * @param bool $success
     * @return JsonResponse
     */
    public function showMessage(
        string $messageKey,
        array $replace = [],
        int $status = 200,
        bool $success = true
    ): JsonResponse {
        return response()->json([
            'success' => $success,
            'message' => __("messages.$messageKey", $replace),
        ], $status);
    }
}