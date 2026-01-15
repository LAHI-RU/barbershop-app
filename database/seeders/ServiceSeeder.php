<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Signature Haircut',
                'description' => 'A precision cut tailored to your face shape, including wash, style, and hot towel finish.',
                'price' => 1800.00,
                'duration_minutes' => 45,
                'category' => 'Haircut',
                'is_active' => true,
            ],
            [
                'name' => 'Classic Fade',
                'description' => 'Precision skin fade or taper using clippers and foil shavers.',
                'price' => 1500.00,
                'duration_minutes' => 30,
                'category' => 'Haircut',
                'is_active' => true,
            ],
            [
                'name' => 'Luxury Hot Towel Shave',
                'description' => 'Traditional straight razor shave with premium oils, hot towels, and cooling balm.',
                'price' => 1600.00,
                'duration_minutes' => 40,
                'category' => 'Shave',
                'is_active' => true,
            ],
            [
                'name' => 'Beard Sculpting',
                'description' => 'Shaping and trimming the beard to perfection including razor line-up.',
                'price' => 1200.00,
                'duration_minutes' => 30,
                'category' => 'Beard Trim',
                'is_active' => true,
            ],
            [
                'name' => 'Charcoal Gold Facial',
                'description' => 'Deep cleansing treatment to remove toxins and revitalize your skin.',
                'price' => 3000.00,
                'duration_minutes' => 50,
                'category' => 'Facial',
                'is_active' => true,
            ],
            [
                'name' => 'The Gentleman Package',
                'description' => 'Our ultimate experience: Signature Cut, Hot Towel Shave, and Express Facial.',
                'price' => 5500.00,
                'duration_minutes' => 100,
                'category' => 'Other',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
