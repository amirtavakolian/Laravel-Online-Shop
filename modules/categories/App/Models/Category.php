<?php

namespace Categories\App\Models;

use Attributes\App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
