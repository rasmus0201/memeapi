<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    /**
     * Get random meme url
     *
     * @return string
     */
    public function random()
    {
        return $this->getJson('gimme')->url;
    }

    /**
     * @inheritdoc
     */
    protected function getApiUrl()
    {
        return 'https://meme-api.herokuapp.com';
    }
}
