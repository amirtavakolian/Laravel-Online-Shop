<?php

namespace Brands\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Brands\App\Http\Requests\StoreBrandRequest;
use Brands\App\Http\Resources\BrandsResource;
use Brands\App\Models\Brand;

class BrandsController extends Controller
{

    public function index()
    {
        $brands = Brand::all();

        return ApiResponseFacade::setData(BrandsResource::collection($brands))->build()->response();
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::query()->create($request->validated());

        return ApiResponseFacade::setMessage(__('messages.brands.brand_successfully_created'))->build()->response();
    }
}
