<?php

namespace App\Repositories;
use App\Models\Link;
use App\Repositories\Interfaces\ILinkRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LinkRepository implements ILinkRepository
{
    public function getByHash($hash): Model|Builder|null
    {
        return Link::query()->where('hash_url', $hash)->first();
    }

    public function createLink(array $data): Model|Builder
    {
        return Link::query()->create([
            'original_url' => $data['url'],
            'hash_url' => Str::random(config('link.length')),
            'expired_at' => $data['expired_at'] ?? Carbon::now()->addDays(30),
        ]);
    }
}
