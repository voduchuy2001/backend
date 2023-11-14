<?php

namespace App\Services\Interfaces;

interface SocialiteServiceInterface
{
    public function redirect(string $provider);
    public function callback(string $provider);
}
