<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductView;
use App\Services\Actions\MediaFileAction;
use App\Services\Actions\ProductLocationAction;
use App\Services\Enums\MediaTypeEnum;
use App\Services\Enums\ProductStatusEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
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

        //create location
        $location = $this->locationAction->create([
            'city' => $data['location_city'],
            'state' => $data['location_state'],
            'country' => $data['location_country'],
        ]);

        //create product
        $product = Product::create([
            'user_id' => $user->id,
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'product_location_id' => $location->id,
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'quantity' => $data['quantity'] ?? null,
            'price' => $data['price'],
            'discount' => $data['discount'],
            'is_negotiable' => $data['is_negotiable'] ?? false,
            'condition' => $data['condition'],
        ]);

        //upload image files
        foreach ($request->file('images') as $key => $image) {
            $imagePath = $this->mediaFileAction->uploadImage($image, 'product_images');
            $product->mediaFiles()->create([
                'path' => $imagePath,
                'media_type' => MediaTypeEnum::image->name,
                'is_featured' => $key == 0,
            ]);
        }

        //upload video file (if any)
        if ($request->file('video')) {
            $videoPath = $this->mediaFileAction->uploadVideo($request->file('video'), 'product_videos');
            $product->mediaFiles()->create([
                'path' => $videoPath,
                'media_type' => MediaTypeEnum::video->name,
            ]);
        }

        $categoryId = $this->getDealCategory($data['category_id']);

        //check if user has a subscription for the product category they want to upload
        $userSubscriptions = $user->subscriptions()
            ->with(['deal' => function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            }])->whereHas('deal', function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })->get()
            ->toArray();

        if (empty($userSubscriptions) || ! $userSubscriptions[0]['is_subscription_valid']) {
            $product->update(['status' => ProductStatusEnum::draft->name]);

            return ApiResponse::pending('You need to subscribe to an appropriate plan, we have saved this as draft');
        }

        $product->update([
            'status' => ProductStatusEnum::pending->name,
            'subscription_id' => $userSubscriptions[0]['id'],
        ]);

        //TODO: send mail to admin for approval
        return ApiResponse::success('Ad successfully sent, patiently wait for approval');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::query()
            ->with(['mediaFiles', 'user', 'location'])
            ->find($id);

        $similarProducts = Product::query()
            ->select(['id', 'category_id', 'sub_category_id', 'product_location_id', 'name', 'price', 'discount', 'is_premium'])
            ->with(['subscription' => function ($query) {
                $query->where('expires_at', '>', now());
            }, 'mediaFiles' => function ($query) {
                $query->where('is_featured', true);
            }, 'location'])
            ->whereHas('subscription', function ($query) {
                $query->where('expires_at', '>', now());
            })
            ->where('sub_category_id', $product->sub_category_id)
            ->orderByDesc('is_premium')
            ->limit(10)
            ->get();

        $authCheck = auth('sanctum')->check();

        if ($authCheck) {
            ProductView::firstOrCreate([
                'product_id' => $product->id,
                'user_id' => \request()->user()->id,
            ]);
        }

        $result = [
            'product' => $product->toArray(),
            'similarProducts' => $similarProducts->toArray(),
        ];

        return ApiResponse::success('Product retrieved successfully', $result);
    }

    public function showBySuperDeal(Request $request)
    {
        $request->validate([
            'deal_name' => 'required|exists:super_deals,name',
        ]);

        $data = $request->all();

        $productsDetails = $this->productsByDeal($data['deal_name']);

        $productsCount = $productsDetails->count();
        $products = $productsDetails->paginate(50);

        $result = [
            'count' => $productsCount,
            'products' => $products->toArray(),
        ];

        return ApiResponse::success('Products by deals retrieved successfully', $result);

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

    /**
     * @return string|null
     */
    protected function getDealCategory(string $categoryId)
    {
        $vehicleId = Category::where('name', 'Vehicles')->first()->id;
        $propertyId = Category::where('name', 'Properties')->first()->id;
        $equipmentId = Category::where('name', 'Industrial, Medical and Construction Tools, Equipment and Machinery')->first()->id;

        return match ($categoryId) {
            $vehicleId, $propertyId, $equipmentId => $categoryId,
            default => null
        };
    }

    protected function productsByDeal(string $name): Builder
    {
        return Product::query()
            ->select(['id', 'user_id', 'subscription_id', 'category_id', 'name', 'price', 'discount', 'quantity'])
            ->with(['category:id,name', 'subscription' => function ($query) {
                $query->where('expires_at', '>', now());
            }, 'subscription.deal:id,super_deal_id',
                'subscription.deal.superDeal' => function ($query2) use ($name) {
                    $query2->where('name', $name);
                }])
            ->whereHas('subscription', function ($query) {
                $query->where('expires_at', '>', now());
            })
            ->whereHas('subscription.deal.superDeal', function ($query2) use ($name) {
                $query2->where('name', $name);
            });
    }
}
