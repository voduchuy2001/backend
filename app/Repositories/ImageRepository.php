<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $image)
    {
        parent::__construct($image);
    }


    public function uploadImage($model, $file)
    {
        $path = $file->store('images');

        $model->images()->create([
            'url' => $path,
        ]);

        return $path;
    }

    public function uploadMultipleImages($model, $files)
    {
        $paths = [];

        foreach ($files as $file) {
            $path = $file->store('images');

            $model->images()->create([
                'url' => $path,
            ]);

            $paths[] = $path;
        }

        return $paths;
    }

    public function deleteOneImage($model, $image)
    {
        $path = $image->url;

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $image->delete();
    }

    public function deleteAllImages($model)
    {
        $images = $model->images;

        foreach ($images as $image) {
            $this->deleteOneImage($model, $image);
        }
    }
}
