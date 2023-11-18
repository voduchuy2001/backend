<?php

namespace App\Http\Controllers\APIs\Admin;

use App\Http\Controllers\APIs\BaseController;
use App\Http\Requests\ProductRequest;
use App\Services\Interfaces\ImageServiceInterface as ImageService;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    protected ProductService $productService;
    protected ImageService $imageService;

    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->paginate(['*'], [], 10, [], ['id', 'DESC'], [], ['images']);
            return $this->withSuccess($products);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $product = $this->productService->create($validatedData);

            if (isset($validatedData['images'])) {
                $this->imageService->uploadMultipleImages($product, $validatedData['images']);
            }

            return $this->withSuccess($product);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function update(string|int $id, ProductRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $product = $this->productService->update($id, $validatedData);
            return $this->withSuccess($product);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }

    public function delete(string|int $id): JsonResponse
    {
        try {
            $product = $this->productService->getById($id);
            $this->productService->delete($id);
            $response = $this->imageService->deleteAllImages($product);
            return $this->withSuccess($response);
        } catch (Exception $exception) {
            return $this->withError($exception->getMessage());
        }
    }
}
