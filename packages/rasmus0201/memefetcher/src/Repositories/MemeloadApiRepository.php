<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeloadApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    /**
     * Get random meme url
     *
     * @return string
     */
    public function random()
    {
        return $this->get('random')->image;
    }

    /**
     * @inheritdoc
     */
    protected function getApiUrl()
    {
        return 'https://api.memeload.us/v1';
    }
}
