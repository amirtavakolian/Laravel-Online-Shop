<?php

namespace Products\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse\ApiResponseFacade;
use Brands\App\Http\Resources\BrandsResource;
use Brands\App\Models\Brand;
use Categories\App\Http\Resources\CategoriesResource;
use Categories\App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Products\App\Actions\CreateProduct;
use Products\App\Actions\CreateProductAttribute;
use Products\App\Actions\UploadImages;
use Products\App\Http\Requests\StoreProductRequest;
use Products\App\Http\Requests\UpdateProductRequest;
use Products\App\Http\Resources\ProductResource;
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
        $products = Product::query()->with(['brand', 'category', 'attributes', 'productVariation', 'images'])->get();

        return ApiResponseFacade::setData(ProductResource::collection($products))->build()->response();
    }

    public function create()
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

    public function update(Product $product, UpdateProductRequest $request)
    {
        // Todo => create 3 apis for edit product and its arrtibutes, edit images, edit product's category and attributes
        if ($request->file('primary_image')) {
            $primaryImage = $this->uploader->update($product->primary_image, [$request->file('primary_image')]);
        }

        if ($request->file('secondary_images')) {
            $secondaryImages = $this->uploader->update($product->images->pluck('image')->toArray(), $request->file('secondary_images'));
        }

        $updatedProduct = Product::query()->update([
            'name' => $request->input('name'),
            'is_active' => $request->input('is_active'),
            'primary_image' => isset($primaryImage) ? reset($primaryImage) : $product->primary_image,
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'delivery_amount' => $request->input('delivery_amount'),
            'delivery_amount_per_product' => $request->input('delivery_amount_per_product'),
        ]);

        $product->images()->delete();

        if (isset($secondaryImages)) {
            $product->images()->insert(
                collect($secondaryImages)
                    ->map(fn($path) => [
                        'product_id' => $product->id,
                        'image' => $path,
                    ])->toArray()
            );
        }

        $product->attributes()->detach();

        ($this->createProductAttribute)($request, $product);

        return ApiResponseFacade::setMessage(__('messages.products.product_successfully_updated'))->build()->response();
    }
}


