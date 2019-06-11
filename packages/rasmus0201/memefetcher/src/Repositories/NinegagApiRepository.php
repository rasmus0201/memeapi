<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class NinegagApiRepository extends HttpRepository implements MemeRepositoryInterface
{
    /**
     * Get random meme url
     *
     * @return string
     */
    public function random()
    {
        $html = $this->get('random');

        preg_match('/GAG\.App\.loadConfigs\((.*)\)\.loadAsynScripts\(\[/', $html, $matches);

        if (!isset($matches[1])) {
            return ['type' => 'image', 'url' => null];
        }

        $post = json_decode($matches[1])->data->post;

        if ($post->type === 'Animated') {
            return ['type' => 'animated', 'url' => urlencode($post->images->image460sv->url)];
        }

        if ($post->type === 'Photo') {
            return ['type' => 'image', 'url' => urlencode($post->images->image700->url)];
        }

        return ['type' => 'image', 'url' => null];
    }

    /**
     * @inheritdoc
     */
    protected function getApiUrl()
    {
        return 'https://9gag.com';
    }
}
