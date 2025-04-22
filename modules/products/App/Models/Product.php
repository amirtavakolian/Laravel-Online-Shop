<?php

namespace Products\App\Models;

use Attributes\App\Models\Attribute;
use Brands\App\Models\Brand;
use Categories\App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot(['value']);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productVariation()
    {
        return $this->hasMany(ProductVariation::class);
    }

}
