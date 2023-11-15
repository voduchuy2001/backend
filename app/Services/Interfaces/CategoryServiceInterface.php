<?php

namespace App\Services\Interfaces;

interface CategoryServiceInterface extends BaseServiceInterface
{
    public function getAllCategoriesWithDescendants();
}
