<?php

namespace Modules\Index\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Categories\App\Models\Category;
use Modules\Banners\app\Models\Banner;
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
}
