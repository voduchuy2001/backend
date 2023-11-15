<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function getAllDescendantsAndSelf($id)
    {
        $category = $this->findById($id);

        if ($category) {
            return $category->getAllDescendantsAndSelf();
        }

        return null;
    }

}
