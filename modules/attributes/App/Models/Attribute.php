<?php

namespace Attributes\App\Models;

use Categories\App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Products\App\Models\Product;

class Attribute extends Model
{

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
