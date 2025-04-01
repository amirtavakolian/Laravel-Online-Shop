<?php

namespace Products\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Brands\App\Http\Resources\BrandsResource;
use Brands\App\Models\Brand;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Models\Category;
use Tags\App\Models\Tag;

class ProductsController extends Controller
{

    public function index()
    {
        $brands = Brand::all();

        $categories = Category::all();

        $tags = Tag::all();

        return ApiResponseFacade::setData([
            'brands' => BrandsResource::collection($brands),
            'categories' => CategoriesResource::collection($categories),
            'tags' => $tags
        ])->build()->response();
    }
}
