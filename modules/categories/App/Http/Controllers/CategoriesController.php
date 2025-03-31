<?php

namespace Categories\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Attributes\App\Models\Attribute;
use Categories\App\Actions\StoreAttributes;
use Categories\App\Actions\StoreCategory;
use Categories\App\Actions\UpdateCategory;
use Categories\App\Http\Requests\StoreCategoryRequest;
use Categories\App\Http\Requests\UpdateCategoryRequest;
use Categories\App\Http\Resources\AttributesResource;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Http\Resources\CategoryAttributesResource;
use Categories\App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct(
        private StoreCategory   $storeCategory,
        private StoreAttributes $storeAttributes,
        private UpdateCategory  $updateCategory
    )
    {
    }

    public function index()
    {
        return ApiResponseFacade::setData([
            'categories' => CategoriesResource::collection(Category::all()),
            'attributes' => AttributesResource::collection(Attribute::all()),
        ])->build()->response();
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('isSuperAdmin', Category::class);

        $newCategory = ($this->storeCategory)($request);

        ($this->storeAttributes)($request, $newCategory);

        return ApiResponseFacade::setMessage(__('messages.categories.category_successfully_created'))
            ->build()->response();
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->authorize('isSuperAdmin', Category::class);

        ($this->updateCategory)($category, $request);

        ($this->storeAttributes)($request, $category);

        return ApiResponseFacade::setMessage(__('messages.categories.category_successfully_created'))
            ->build()->response();
    }

    public function show(Category $category)
    {
        return ApiResponseFacade::setData([
            'category' => new CategoriesResource($category),
            'category_attributes' => CategoryAttributesResource::collection($category->attributes)
        ])->build()->response();
    }

    public function destroy(Category $category)
    {
        $this->authorize('isSuperAdmin', Category::class);

        $category->delete();

        return ApiResponseFacade::setMessage(__('messages.categories.category_successfully_deleted'))
            ->build()->response();
    }
}




