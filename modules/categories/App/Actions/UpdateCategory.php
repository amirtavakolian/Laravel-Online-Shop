<?php

namespace Categories\App\Actions;

class UpdateCategory
{
    public function __invoke($category, $request)
    {
        return $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'is_active' => $request->input('is_active'),
            'icon' => $request->input('icon'),
        ]);
    }
}
