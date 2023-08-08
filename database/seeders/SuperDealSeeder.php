<?php

namespace Database\Seeders;

use App\Models\SuperDeal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperDealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superDeals = [
            'Jumbo' => [
                [
                    ""
                ]
            ],
            'Dandy',
            'Nifty',
            'Galore',
            'Optimum',
            'Mega',
            'Jolly',
            'Superstore'
        ];

        foreach ($superDeals as $superDeal) {
            SuperDeal::create(['name' => $superDeal]);
        }
    }
}
