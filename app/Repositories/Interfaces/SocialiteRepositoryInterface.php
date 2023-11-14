<?php

namespace App\Repositories\Interfaces;

interface SocialiteRepositoryInterface
{
    public function firstOrCreate(string $providerId, string $provider, int $userId);
}
