<?php

namespace App\Repositories\Interfaces;

interface ILinkRepository
{
    public function getByHash($hash);

    public function createLink(array $data);
}
