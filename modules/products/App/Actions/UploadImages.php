<?php

namespace Products\App\Actions;

use Illuminate\Support\Facades\Storage;

class UploadImages
{
    const PRODUCT_IMAGES_PATH = 'public/images/products';

    private array $images;

    public function update($oldImages, $images)
    {
        Storage::delete($oldImages);

        return $this->upload($images);
    }

    public function upload($images): array
    {
        $this->images = collect($images)->map(function ($image) {
            return $image->storeAs(self::PRODUCT_IMAGES_PATH, $image->hashName());
        })->toArray();

        return $this->images;
    }
}
