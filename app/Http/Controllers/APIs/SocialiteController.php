<?php

namespace App\Http\Controllers\APIs;

use App\Services\Interfaces\SocialiteServiceInterface as SocialiteService;
use Exception;
use Illuminate\Http\JsonResponse;

class SocialiteController extends BaseController
{
    protected SocialiteService $socialiteService;

    public function __construct(SocialiteService $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }

    public function redirect(string $provider): JsonResponse
    {
        try {
            $urlRedirect = $this->socialiteService
                ->redirect($provider);

            return $this->withSuccess([
                'urlRedirect' => $urlRedirect,
            ]);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function callback(string $provider): JsonResponse
    {
        try {
            $data = $this->socialiteService->callback($provider);
            return $this->withSuccess($data);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }
}
