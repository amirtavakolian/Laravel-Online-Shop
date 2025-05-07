<?php

namespace Categories\App\Models;

use Attributes\App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Products\App\Models\Product;

class Category extends Model
{

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot(['is_filter', 'is_variation']);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
