<?php

namespace Modules\Banners\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Illuminate\Http\Request;
use Modules\Banners\app\Http\Requests\StoreBannerRequest;
use Modules\Banners\app\Models\Banner;
use Modules\Banners\app\Services\UploaderService;

class BannersController extends Controller
{

    public function __construct(private UploaderService $uploaderService)
    {
    }

    public function store(StoreBannerRequest $request)
    {
        $image = $this->uploaderService->upload($request->file('image'));

        Banner::query()->create([
            ...$request->validated(),
            'image' => $image,
        ]);

        return ApiResponseFacade::setMessage(__('messages.banners.banner_successfully_created'))->build()->response();
    }
}
