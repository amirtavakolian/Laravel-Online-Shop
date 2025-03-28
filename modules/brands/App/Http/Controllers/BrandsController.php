<?php

namespace Brands\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Brands\App\Http\Resources\BrandsResource;
use Brands\App\Models\Brand;

class BrandsController extends Controller
{

    public function index()
    {
        $brands = Brand::all();

        return ApiResponseFacade::setData(BrandsResource::collection($brands))->build()->response();
    }
}
