<?php

namespace Categories\App\Actions;

class StoreAttributes
{
    public function __invoke($request, $category)
    {
        $categoryAttributes = array_map(function ($filter) {
            return [
                'attribute_id' => $filter,
                'is_filter' => 1,
                'is_variation' => 0
            ];
        }, $request->input('is_filter'));

        $categoryAttributes[] = [
            'attribute_id' => $request->input('is_variation'),
            'is_filter' => 0,
            'is_variation' => 1
        ];

        $category->attributes()->detach();

        $category->attributes()->sync($categoryAttributes);
    }
}
