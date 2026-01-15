<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Barber;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Dasun Perera',
                'email' => 'dasun@example.com',
                'phone' => '0771234567',
                'bio' => 'Master Barber with over 10 years of experience in classic scissor cuts and modern skin fades. The perfectionist of the shop.',
                'image_url' => 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?q=80&w=1974&auto=format&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Kasun Silva',
                'email' => 'kasun@example.com',
                'phone' => '0777654321',
                'bio' => 'Senior Grooming Expert. Specializes in luxury hot towel shaves and therapeutic head massages. Your comfort is his priority.',
                'image_url' => 'https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?q=80&w=2080&auto=format&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Nuwan Jayasekara',
                'email' => 'nuwan@example.com',
                'phone' => '0712345678',
                'bio' => 'Beard Sculpting Specialist. Known for his surgical precision with the straight razor and beard styling.',
                'image_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=1974&auto=format&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Amal Fernando',
                'email' => 'amal@example.com',
                'phone' => '0709876543',
                'bio' => 'Modern Stylist. Expert in contemporary hair designs, hair coloring, and advanced facial treatments.',
                'image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1974&auto=format&fit=crop',
                'is_active' => true,
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}
