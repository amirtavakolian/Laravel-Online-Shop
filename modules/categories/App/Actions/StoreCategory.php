<?php

namespace Categories\App\Actions;

use Categories\App\Models\Category;

class StoreCategory
{
    public function __invoke($request)
    {
        return Category::query()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'is_active' => $request->input('is_active'),
            'icon' => $request->input('icon'),
        ]);
    }
}
