<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dashboard = Product::query()
            ->select(['id', 'user_id', 'subscription_id', 'name', 'price', 'discount'])
            ->with(['subscription' => function ($query) {
                $query->where('expires_at', '>', now());
            }, 'subscription.deal:id,super_deal_id',
                'subscription.deal.superDeal' => function ($query2) {
                    $query2->where('name', 'Optimum');
                }])
            ->whereHas('subscription', function ($query) {
                $query->where('expires_at', '>', now());
            })
            ->whereHas('subscription.deal.superDeal', function ($query2) {
                $query2->where('name', 'Optimum');
            })
            ->inRandomOrder()
            ->get()
            ->toArray();

        dump($dashboard);
    }
}
