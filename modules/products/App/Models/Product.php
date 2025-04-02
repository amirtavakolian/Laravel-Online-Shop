<?php

namespace Products\App\Models;

use Attributes\App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
