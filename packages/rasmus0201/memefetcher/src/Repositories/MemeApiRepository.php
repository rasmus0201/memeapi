<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    public function random()
    {
        return $this->get('gimme')->url;
    }

    protected function getApiUrl()
    {
        return 'https://meme-api.herokuapp.com';
    }
}
