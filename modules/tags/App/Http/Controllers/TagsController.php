<?php

namespace Tags\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Tags\App\Http\Requests\StoreTagRequest;
use Tags\App\Http\Requests\UpdateTagRequest;
use Tags\App\Models\Tag;

class TagsController extends Controller
{

    public function index()
    {
        return ApiResponseFacade::setData(Tag::all())->build()->response();
    }

    public function store(StoreTagRequest $request)
    {
        Tag::query()->create($request->validated());

        return ApiResponseFacade::setMessage(__('messages.tags.tag_successfully_created'))->build()->response();
    }

    public function show(Tag $tag)
    {
        return ApiResponseFacade::setData(['tags' => $tag])->build()->response();
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return ApiResponseFacade::setMessage(__('messages.tags.tag_successfully_updated'))->build()->response();

    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return ApiResponseFacade::setMessage(__('messages.tags.tag_successfully_deleted'))->build()->response();
    }
}
