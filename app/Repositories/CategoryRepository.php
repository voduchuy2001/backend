<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected Category $category;

    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->category = $category;
    }

    public function getAllCategoriesWithDescendants()
    {
        return $this->category->whereNull('parent_id')
            ->get()
            ->flatMap(function ($category) {
                return $category->getAllCategoriesWithDescendants();
            });
    }
}
