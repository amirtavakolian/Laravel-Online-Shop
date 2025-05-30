<?php

namespace Products\App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $guarded = [];
    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
