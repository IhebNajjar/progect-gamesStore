<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'title' => 'The Witcher 3: Wild Hunt',
                'genre' => 'RPG',
                'platform' => 'PC',
                'description' => 'A visually stunning open-world RPG where you play as Geralt of Rivia, a professional monster hunter.',
                'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=400',
                'price' => 29.99,
                'stock' => 10,
            ],
            [
                'title' => 'Grand Theft Auto V',
                'genre' => 'Action',
                'platform' => 'PS5',
                'description' => 'Experience the ultimate open-world action game set in Los Santos.',
                'image_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=400',
                'price' => 39.99,
                'stock' => 5,
            ],
            [
                'title' => 'Elden Ring',
                'genre' => 'Soulslike',
                'platform' => 'PC',
                'description' => 'A massive open-world soulslike game from FromSoftware and George R.R. Martin.',
                'image_url' => 'https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?auto=format&fit=crop&q=80&w=400',
                'price' => 59.99,
                'stock' => 8,
            ],
            [
                'title' => 'FIFA 24',
                'genre' => 'Sports',
                'platform' => 'Xbox',
                'description' => 'The latest iteration of the world-famous football simulation.',
                'image_url' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=400',
                'price' => 69.99,
                'stock' => 15,
            ],
            [
                'title' => 'Cyberpunk 2077',
                'genre' => 'RPG',
                'platform' => 'PC',
                'description' => 'An open-world, action-adventure story set in Night City, a megalopolis obsessed with power.',
                'image_url' => 'https://images.unsplash.com/photo-1605898960764-7565bad3f901?auto=format&fit=crop&q=80&w=400',
                'price' => 49.99,
                'stock' => 3,
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
