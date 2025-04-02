<?php

namespace Products\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Brands\App\Http\Resources\BrandsResource;
use Brands\App\Models\Brand;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Models\Category;
use Illuminate\Support\Facades\DB;
use Products\App\Actions\CreateProduct;
use Products\App\Actions\CreateProductAttribute;
use Products\App\Actions\UploadImages;
use Products\App\Http\Requests\StoreProductRequest;
use Products\App\Models\Product;
use Products\App\Models\ProductVariation;
use Tags\App\Models\Tag;

class ProductsController extends Controller
{
    public function __construct(
        private UploadImages           $uploader,
        private CreateProduct          $createProduct,
        private CreateProductAttribute $createProductAttribute)
    {
    }

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

    public function store(StoreProductRequest $request)
    {
        $primaryImage = $this->uploader->upload([$request->file('primary_image')]);

        $secondaryImages = $this->uploader->upload($request->file('secondary_images'));

        $newProduct = ($this->createProduct)($request, ['primary_image' => $primaryImage, 'secondary_images' => $secondaryImages]);

        ($this->createProductAttribute)($request, $newProduct);

        return ApiResponseFacade::setMessage(__('messages.products.product_successfully_created'))->build()->response();
    }

    
}


