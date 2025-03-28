<?php

namespace Attributes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Attributes\App\Http\Resources\AttributeResources;
use Attributes\App\Models\Attribute;

class AttributesController extends Controller
{

    public function index()
    {
        $attributes = Attribute::all();

        return ApiResponseFacade::setData(AttributeResources::collection($attributes))->build()->response();
    }
}
