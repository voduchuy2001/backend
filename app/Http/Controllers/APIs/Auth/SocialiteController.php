<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\APIs\BaseController;
use App\Services\Interfaces\SocialiteServiceInterface as SocialiteService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

            return $this->withSuccess($urlRedirect);
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

    public function authUser(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            return $this->withSuccess($user);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }
}
