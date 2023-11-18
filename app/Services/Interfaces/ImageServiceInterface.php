<?php

namespace App\Services\Interfaces;

interface ImageServiceInterface
{
    public function uploadImage($model, $file);
    public function uploadMultipleImages($model, $files);
    public function deleteOneImage($model, $image);
    public function deleteAllImages($model);
}
