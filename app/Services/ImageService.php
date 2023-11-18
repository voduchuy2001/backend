<?php

namespace App\Services;

use App\Repositories\Interfaces\ImageRepositoryInterface as ImageRepository;
use App\Services\Interfaces\ImageServiceInterface;

class ImageService implements ImageServiceInterface
{
    protected ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function uploadImage($model, $file)
    {
        return $this->imageRepository->uploadImage($model, $file);
    }

    public function uploadMultipleImages($model, $files)
    {
        return $this->imageRepository->uploadMultipleImages($model, $files);
    }

    public function deleteOneImage($model, $image)
    {
        return $this->imageRepository->deleteOneImage($model, $image);
    }

    public function deleteAllImages($model)
    {
        $this->imageRepository->deleteAllImages($model);
    }
}
