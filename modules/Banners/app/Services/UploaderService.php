<?php

namespace Modules\Banners\app\Services;

use Illuminate\Support\Facades\Storage;

class UploaderService
{
    const PATH = 'public/images/banners';

    public function update($oldImage, $images)
    {
        Storage::delete($oldImage);

        return $this->upload($images);
    }

    public function upload($image)
    {
        return $image->storeAs(self::PATH, $image->hashName());
    }
}
