<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeloadApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    public function random()
    {
        return $this->get('random')->image;
    }

    protected function getApiUrl()
    {
        return 'https://api.memeload.us/v1';
    }
}
