<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use GuzzleHttp\Client as GuzzleClient;

abstract class HttpRepository
{
    /**
     * @var GuzzleClient $guzzleClient
     */
    private $guzzleClient;

    abstract protected function getApiUrl();

    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    protected function get($url)
    {
        return $this->jsonFetch('GET', $url);
    }

    private function jsonFetch($method, $url)
    {
        $response = $this->guzzleClient->request($method, $this->constructUrl($url));

        return $this->jsonResponse($response);
    }

    private function jsonResponse($response)
    {
        return json_decode($response->getBody()->getContents());
    }

    private function constructUrl($url)
    {
        return rtrim($this->getApiUrl(), '/') . '/' . ltrim($url, '/');
    }
}
