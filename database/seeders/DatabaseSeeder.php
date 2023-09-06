<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\ProductImpression;
use App\Models\ProductMediaFile;
use App\Models\ProductView;
use App\Models\Subscription;
use App\Models\User;
use App\Services\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->call([
//            RolePermissionSeeder::class,
//            CategorySeeder::class,
//            SuperDealSeeder::class,
//        ]);
//
//        User::factory()->create()->each(function ($user) {
//            $user->assignRole(UserRoleEnum::customer->name);
//        });
//
//        Subscription::factory(10)->create();
//        Product::factory(250)->create();

        ProductMediaFile::factory(400)->create();

//        ProductView::factory(120)->create();
//        ProductImpression::factory(130)->create();

    }
}
