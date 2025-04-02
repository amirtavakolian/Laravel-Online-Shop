<?php

namespace Products\App\Actions;

class UploadImages
{

    const PRODUCT_IMAGES_PATH = 'public/images/products';

    public function upload($primaryImage, $secondaryImage)
    {
        $images = [];

        $images['primary_image'] = $primaryImage->storeAs(self::PRODUCT_IMAGES_PATH, $primaryImage->hashName());

        $images['secondary_images'] = collect($secondaryImage)->map(function ($image) {
            return ['image' => $image->storeAs(self::PRODUCT_IMAGES_PATH, $image->hashName())];
        })->toArray();

        return $images;
    }
}
