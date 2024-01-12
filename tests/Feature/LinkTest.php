<?php

namespace Tests\Feature;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @throws \JsonException
     */
    public function test_shorter_link(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. config('auth.token'),
            'Accept' => 'application/json'
        ])->post('/api/shorter', [
            'url' => 'https://google.com'
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertJsonStructure(['data' => ['link']]);

        $this->assertDatabaseCount('links', 1);
        $this->assertDatabaseHas('links', [
            'original_url' => 'https://google.com'
        ]);

        $response->assertStatus(201);
    }

    public function test_shorter_link_failed(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/shorter', [
            'url' => 'https://google.com'
        ]);

        $response->assertJsonStructure(['message', 'code']);

        $response->assertStatus(403);
    }

    public function test_shorter_link_validate(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. config('auth.token'),
        ])->post('/api/shorter', [
            'url' => 'google.com'
        ]);

        $response->assertJsonValidationErrors(['url']);
        $response->assertJsonStructure(['message', 'errors']);

        $response->assertStatus(422);
    }

    public function test_redirect_link(): void
    {
        $link = Link::query()->create([
            'hash_url' => Str::random(config('link.length')),
            'original_url' => 'https://youtube.com',
            'expired_at' => Carbon::now()->addDays(10),
        ]);

        $response = $this->get('/'.$link->hash_url);
        $response->assertLocation('https://youtube.com');
        $response->assertStatus(302);
    }

    public function test_redirect_link_expired_at(): void
    {
        $link = Link::query()->create([
            'hash_url' => Str::random(config('link.length')),
            'original_url' => 'https://youtube.com',
            'expired_at' => Carbon::now()->subDays(10),
        ]);

        $response = $this->get('/'.$link->hash_url);
        $response->assertLocation(config('link.failed'));
        $response->assertStatus(302);
    }

    public function test_redirect_link_not_found(): void
    {
        $response = $this->get('/asd');
        $response->assertLocation(config('link.not_found'));
        $response->assertStatus(302);
    }
}
