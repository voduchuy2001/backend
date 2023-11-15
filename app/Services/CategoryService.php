<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoriesWithDescendants()
    {
        return $this->categoryRepository->getAllCategoriesWithDescendants();
    }
}
