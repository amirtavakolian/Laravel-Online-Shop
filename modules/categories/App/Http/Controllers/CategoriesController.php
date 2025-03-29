<?php

namespace Categories\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Attributes\App\Models\Attribute;
use Categories\App\Http\Resources\AttributesResource;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Models\Category;

class CategoriesController extends Controller
{

    public function index()
    {
        return ApiResponseFacade::setData([
            'categories' => CategoriesResource::collection(Category::all()),
            'attributes' => AttributesResource::collection(Attribute::all()),
        ])->build()->response();
    }
}
