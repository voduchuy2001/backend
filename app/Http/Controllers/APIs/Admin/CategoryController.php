<?php

namespace App\Http\Controllers\APIs\Admin;

use App\Http\Controllers\APIs\BaseController;
use App\Http\Requests\CategoryRequest;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        try {
            $categories = $this->categoryService->getAllCategoriesWithDescendants();
            return $this->withSuccess($categories);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $category = $this->categoryService->create($validatedData);
            return $this->withSuccess($category);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $category = $this->categoryService->update($id, $validatedData);
            return $this->withSuccess($category);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->delete($id);
            return $this->withSuccess($category);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }
}
