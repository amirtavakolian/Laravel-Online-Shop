<?php

namespace Modules\Index\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Categories\App\Models\Category;
use Illuminate\Support\Collection;
use Modules\Banners\app\Models\Banner;
use Modules\Index\app\Resources\CategoryAttributesResource;
use Modules\Index\app\Resources\CategoryVariationAttributesResource;
use Products\App\Http\Resources\ProductResource;
use Products\App\Models\Product;

class IndexController extends Controller
{

    public function index()
    {
        $categories = Category::with('parent')->get();

        $banners = Banner::all(); // slider & banner => order by priority

        $products = Product::with([
            'productVariation' => function ($query) {
                $query->where('quantity', '>', 0);
            },
            'images',
            'attributes',
            'brand',
            'category'])->hasQuantity()->where('is_active', 1)->get();

        return ApiResponseFacade::setData([$categories, $banners, $products])->build()->response();
    }

    public function category(Category $category)
    {
        $filters = $category->attributes()->where('is_filter', 1)->with('filterAttributesValue')->get();

        $variations = $category->attributes()->where('is_variation', 1)->with('variationAttributesValue')->get();

        $categoryProducts = Product::query()->when(request()->has('attribute'), function ($query) {
            return $query->whereHas('attributes', function ($query) {
                return $query->where('value', request()->get('attribute'));
            });
        });

        $categoryProducts = Product::query()->when(request()->has('variation'), function ($query) {
            return $query->whereHas('productVariation', function ($query) {
                return $query->where('value', request()->get('variation'));
            });
        });

        return ApiResponseFacade::setData([
            'attributes' => CategoryAttributesResource::collection($filters),
            'variation_attributes' => CategoryVariationAttributesResource::collection($variations),
            'products' => ProductResource::collection($categoryProducts->get())
        ])->build()->response();
    }
}
