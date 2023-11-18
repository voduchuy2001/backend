<?php

namespace App\Repositories;

use App\Models\SocialAccount;
use App\Repositories\Interfaces\SocialiteRepositoryInterface;

class SocialiteRepository extends BaseRepository implements SocialiteRepositoryInterface
{
    public function __construct(SocialAccount $socialAccount)
    {
        parent::__construct($socialAccount);
    }

    public function firstOrCreate(string $providerId, string $provider, string|int $userId)
    {
        $socialAccount = SocialAccount::where(function ($query) use ($providerId, $userId) {
            $query->where('provider_id', $providerId)
                ->where('user_id', $userId);
        })->first();

        if (!$socialAccount) {
            $socialAccount = $this->create([
                'provider_id' => $providerId,
                'provider' => $provider,
                'user_id' => $userId,
            ]);
        }

        return $socialAccount;
    }
}
