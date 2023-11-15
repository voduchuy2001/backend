<?php

namespace App\Services;

use App\Repositories\Interfaces\SocialiteRepositoryInterface as SocialiteRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\SocialiteServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService implements SocialiteServiceInterface
{
    protected UserRepository $userRepository;
    protected SocialiteRepository $socialiteRepository;

    public function __construct(
        UserRepository $userRepository,
        SocialiteRepository $socialiteRepository
    ) {
        $this->userRepository = $userRepository;
        $this->socialiteRepository = $socialiteRepository;
    }

    public function redirect(string $provider): ?string
    {
        if (!$this->catchError($provider)) {
            return null;
        }

        $response = Socialite::driver($provider)->stateless()->redirect();
        return $response->getTargetUrl();
    }

    public function callback(string $provider): string
    {
        $socialAccount = Socialite::driver($provider)
            ->stateless()
            ->user();

        if (!$socialAccount) {
            return 'Failed to authenticate with ' . $provider;
        }

        $user = $this->userRepository->firstOrCreate($socialAccount->getEmail(), [
            'name' => $socialAccount->getName(),
            'password' => Hash::make(Str::random(10)),
            'email_verified_at' => Carbon::now(),
        ]);

        $this->socialiteRepository
            ->firstOrCreate(
                $provider,
                $socialAccount->getId(),
                $user->id
            );

        return $user->createToken('Ecommerce_VDH')->plainTextToken;
    }

    protected function catchError(string $provider): bool
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return false;
        }

        return true;
    }
}
