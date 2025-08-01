<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotFoundException extends Exception
{
    protected $statusCode;

    public function __construct(string $message = null, int $statusCode = 404)
    {
        // Hata mesajı boşsa lang dosyasından al
        parent::__construct($message ?? __('user.not_found'));

        $this->statusCode = $statusCode;
    }

    /**
     * Bu exception log'a yazılsın mı?
     */
    public function report(): bool
    {
        // Loglama istemiyorsan false döndür.
        return false;
    }

    /**
     * Exception'ın istemciye nasıl döneceğini özelleştir
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
        ], $this->statusCode);
    }
}
