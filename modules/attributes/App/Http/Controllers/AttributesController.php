<?php

namespace Attributes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Attributes\App\Http\Requests\StoreAttributeRequest;
use Attributes\App\Http\Requests\UpdateAttributeRequest;
use Attributes\App\Http\Resources\AttributeResources;
use Attributes\App\Models\Attribute;

class AttributesController extends Controller
{

    public function index()
    {
        $attributes = Attribute::all();

        return ApiResponseFacade::setData(AttributeResources::collection($attributes))->build()->response();
    }

    public function store(StoreAttributeRequest $request)
    {
        $this->authorize('isSuperAdmin', Attribute::class);

        Attribute::query()->create($request->validated());

        return ApiResponseFacade::setMessage(__('messages.attributes.attribute_successfully_created'))->build()->response();
    }

    public function update(Attribute $attribute, UpdateAttributeRequest $request)
    {
        $this->authorize('isSuperAdmin', Attribute::class);

        $attribute->update($request->validated());

        return ApiResponseFacade::setMessage(__('messages.brands.brand_successfully_updated'))
            ->build()->response();
    }

    public function destroy(Attribute $attribute)
    {
        $this->authorize('isSuperAdmin', Attribute::class);

        $attribute->delete();

        return ApiResponseFacade::setMessage(__('messages.brands.brand_successfully_deleted'))->build()->response();
    }
}
