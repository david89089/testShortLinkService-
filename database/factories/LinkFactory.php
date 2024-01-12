<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'original_url' => fake()->url,
            'hash_url' => Str::random(config('link.length')),
            'expired_at' => now(),
        ];
    }
}
