<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Resources\LinkResource;
use App\Repositories\Interfaces\ILinkRepository;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function store(LinkStoreRequest $request, ILinkRepository $linkRepository): LinkResource
    {
        $link = $linkRepository->createLink($request->validated());

        return new LinkResource($link);
    }
}
