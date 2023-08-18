<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SuperDeal;
use Illuminate\Database\Seeder;

class SuperDealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleId = Category::where('name', 'Vehicles')->first()->id;
        $propertyId = Category::where('name', 'Properties')->first()->id;
        $equipmentId = Category::where('name', 'Industrial, Medical and Construction Tools, Equipment and Machinery')->first()->id;

        $superDeals = [
            'Jumbo' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 350,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => null,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 400,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => null,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Dandy' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 350,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => null,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 300,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => null,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Nifty' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 200,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => null,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 400,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 400,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Galore' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 150,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => null,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 200,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 300,
                    'auto_renewal' => 6,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Optimum' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 70,
                    'auto_renewal' => 12,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => 100,
                    'auto_renewal' => 12,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 150,
                    'auto_renewal' => 12,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 350,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Mega' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 30,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => 80,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 100,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 100,
                    'auto_renewal' => 3,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Jolly' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 20,
                    'auto_renewal' => 48,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => 40,
                    'auto_renewal' => 48,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 10,
                    'auto_renewal' => 48,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 60,
                    'auto_renewal' => 48,
                    'prices' => [
                        [
                            'amount' => 11000,
                            'duration_value' => 1,
                            'duration' => 'Week',
                        ],
                        [
                            'amount' => 42000,
                            'duration_value' => 1,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 85050,
                            'duration_value' => 3,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 149975,
                            'duration_value' => 6,
                            'duration' => 'Month',
                        ],
                        [
                            'amount' => 262150,
                            'duration_value' => 12,
                            'duration' => 'Month',
                        ],
                    ],
                ],
            ],
            'Free' => [
                [
                    'category_id' => $vehicleId,
                    'name' => 'Vehicles',
                    'selected_ads' => 1,
                    'auto_renewal' => null,
                    'visibility' => false,
                    'notifications' => false,
                    'promotions' => false,
                    'consultations' => false,
                    'reports' => false,
                    'feedbacks' => false,
                ],
                [
                    'category_id' => $propertyId,
                    'name' => 'Properties',
                    'selected_ads' => 1,
                    'auto_renewal' => null,
                    'visibility' => false,
                    'notifications' => false,
                    'promotions' => false,
                    'consultations' => false,
                    'reports' => false,
                    'feedbacks' => false,
                ],
                [
                    'category_id' => $equipmentId,
                    'name' => 'Equipments & industrial',
                    'selected_ads' => 1,
                    'auto_renewal' => null,
                    'visibility' => false,
                    'notifications' => false,
                    'promotions' => false,
                    'consultations' => false,
                    'reports' => false,
                    'feedbacks' => false,
                ],
                [
                    'category_id' => null,
                    'name' => 'Other Categories',
                    'selected_ads' => 5,
                    'auto_renewal' => null,
                    'visibility' => false,
                    'notifications' => false,
                    'promotions' => false,
                    'consultations' => false,
                    'reports' => false,
                    'feedbacks' => false,
                ],
            ],
        ];

        foreach ($superDeals as $key => $superDeal) {
            $createdSuperDeal = SuperDeal::query()->create(['name' => $key]);
            $deals = $superDeal;
            foreach ($deals as $deal) {
                $prices = $deal['prices'] ?? [];
                unset($deal['prices']);
                $createdDeal = $createdSuperDeal->deals()->create($deal);

                foreach ($prices as $price) {
                    $createdDeal->prices()->create($price);
                }
            }
        }
    }
}
