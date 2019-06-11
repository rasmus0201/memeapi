<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class GiphyStickerApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    /**
     * Get random gif url
     *
     * @return string
     */
    public function random()
    {
        $random = $this->get('v1/stickers/random' . $this->credentials());

        return 'https://i.giphy.com/' . $random->data->id . '.gif';
    }

    /**
     * @inheritdoc
     */
    protected function getApiUrl()
    {
        return 'https://api.giphy.com';
    }

    /**
     * Get API credentials
     *
     * @return string
     */
    private function credentials()
    {
        return '?api_key=' . config('memefetcher.services.giphy.api_key');
    }
}
