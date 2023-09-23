<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SuperDeal;
use App\Models\User;
use App\Services\Enums\ProductStatusEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|exists:super_deals,name',
            'limit' => 'nullable|integer',
        ]);

        $data = $request->all();
        $result = $this->eachProduct($data['name'], $data['limit']);

        return ApiResponse::success('Dashboard fetched successfully', $result);
    }

    protected function eachProduct(string $name, ?int $limit): array
    {
        return Product::query()
            ->select(['id', 'user_id', 'subscription_id', 'name', 'price', 'discount'])
            ->with(['subscription.deal:id,super_deal_id',
                'mediaFiles' => function ($query) {
                $query->where('is_featured', true)->first();
            }])
            ->withWhereHas('subscription', function ($query) {
                $query->where('expires_at', '>', now());
            })
            ->withWhereHas('subscription.deal.superDeal', function ($query2) use ($name) {
                $query2->where('name', $name);
            })
            ->where('status', ProductStatusEnum::active->name)
            ->inRandomOrder()
            ->limit($limit ?? 10)
            ->without('subscription')
            ->get()
            ->toArray();

        //            Product::query()
        //            ->select(['id', 'user_id', 'subscription_id', 'name', 'price', 'discount'])
        //            ->with(['subscription' => function ($query) {
        //                $query->where('expires_at', '>', now());
        //            }, 'subscription.deal:id,super_deal_id',
        //                'subscription.deal.superDeal' => function ($query2) use ($name) {
        //                    $query2->where('name', $name);
        //                }])
        //            ->whereHas('subscription', function ($query) {
        //                $query->where('expires_at', '>', now());
        //            })
        //            ->whereHas('subscription.deal.superDeal', function ($query2) use ($name) {
        //                $query2->where('name', $name);
        //            })
        //            ->inRandomOrder()
        //            ->limit($limit ?? 10)
        //            ->get()
        //            ->toArray();
    }
}
