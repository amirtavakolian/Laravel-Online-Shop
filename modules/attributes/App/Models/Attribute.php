<?php

namespace Attributes\App\Models;

use Categories\App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Modules\products\App\Models\ProductAttribute;
use Products\App\Models\Product;
use Products\App\Models\ProductVariation;

class Attribute extends Model
{

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['value', 'attribute_id']);
    }

    public function filterAttributesValue()
    {
        return $this->hasMany(ProductAttribute::class)->distinct();
    }

    public function variationAttributesValue()
    {
        return $this->hasMany(ProductVariation::class)->distinct();
    }
}
