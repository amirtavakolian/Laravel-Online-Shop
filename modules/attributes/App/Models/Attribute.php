<?php

namespace Attributes\App\Models;

use Categories\App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
