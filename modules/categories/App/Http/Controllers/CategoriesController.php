<?php

namespace Categories\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Attributes\App\Models\Attribute;
use Categories\App\Actions\StoreAttributes;
use Categories\App\Actions\StoreCategory;
use Categories\App\Actions\StoreOrUpdateAttributes;
use Categories\App\Actions\StoreOrUpdateCategory;
use Categories\App\Http\Requests\StoreCategoryRequest;
use Categories\App\Http\Resources\AttributesResource;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Models\Category;

class CategoriesController extends Controller
{

    public function __construct(
        private StoreCategory  $storeCategory,
        private StoreAttributes $storeAttributes
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
        $newCategory = ($this->storeCategory)($request);

        ($this->storeAttributes)($request, $newCategory);

        return ApiResponseFacade::setMessage(__('messages.categories.category_successfully_created'))
            ->build()->response();
    }

        return ApiResponseFacade::setMessage(__('messages.categories.category_successfully_created'))
            ->build()->response();
    }
}




