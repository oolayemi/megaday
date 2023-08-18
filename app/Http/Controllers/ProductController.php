<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Services\Actions\MediaFileAction;
use App\Services\Actions\ProductLocationAction;
use App\Services\Enums\MediaTypeEnum;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public MediaFileAction $mediaFileAction;

    public ProductLocationAction $locationAction;

    public function __construct()
    {
        $this->mediaFileAction = new MediaFileAction();
        $this->locationAction = new ProductLocationAction();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $user = $request->user();

        $product = Product::create([
            'user_id' => $user->id,
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'product_location_id' => $this->locationAction->create($data['location'])->id,
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'quantity' => $data['quantity'] ?? null,
            'price' => $data['price'],
            'discount' => $data['discount'],
            'is_negotiable' => $data['is_negotiable'] ?? false,
            'condition' => $data['condition'],
        ]);

        foreach ($request->file('images') as $key => $image) {
            $imagePath = $this->mediaFileAction->uploadImage($image);
            $product->mediaFiles()->create([
                'path' => $imagePath,
                'media_type' => MediaTypeEnum::image->name,
                'is_featured' => $key == 0,
            ]);
        }

        if ($request->file('video')) {
            $videoPath = $this->mediaFileAction->uploadVideo($request->file('video'));
            $product->mediaFiles()->create([
                'path' => $videoPath,
                'media_type' => MediaTypeEnum::video->name,
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
