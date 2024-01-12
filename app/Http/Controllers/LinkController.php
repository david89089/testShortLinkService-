<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Repositories\LinkRepository;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LinkController extends Controller
{
    public function index($link, LinkRepository $linkRepository)
    {
        $link = $linkRepository->getByHash($link);
        if($link && $link->expired_at > now()) {
            $checkUrl = Http::get($link->original_url);
            if($checkUrl->status() == ResponseAlias::HTTP_OK) {
                return redirect($link->original_url);
            }

            return redirect(config('failed'));
        }

        return redirect(config('link.not_found'));
    }
}
