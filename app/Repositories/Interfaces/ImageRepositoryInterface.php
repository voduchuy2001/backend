<?php

namespace App\Repositories\Interfaces;

interface ImageRepositoryInterface extends BaseRepositoryInterface
{
    public function uploadImage($model, $file);
    public function uploadMultipleImages($model, $files);
    public function deleteOneImage($model, $image);
    public function deleteAllImages($model);
}
