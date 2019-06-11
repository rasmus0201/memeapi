<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use GuzzleHttp\Client as GuzzleClient;

abstract class HttpRepository
{
    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * Get the api url for the repository
     *
     *  @return string
     */
    abstract protected function getApiUrl();

    /**
     * Constructor
     *
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * GET method for api
     *
     * @param string $url
     *
     * @return \stdClass
     */
    protected function get($url)
    {
        return $this->fetch('GET', $url);
    }

    /**
     * GET method for api (returns json data)
     *
     * @param string $url
     *
     * @return \stdClass
     */
    protected function getJson($url)
    {
        return $this->jsonFetch('GET', $url);
    }

    /**
     * Fetch data by some HTTP method
     *
     * @param string $method
     * @param string $url
     *
     * @return \stdClass
     */
    private function fetch($method, $url)
    {
        $response = $this->guzzleClient->request($method, $this->constructUrl($url));

        return $response->getBody()->getContents();
    }

    /**
     * Fetch JSON data by some HTTP method
     *
     * @param string $method
     * @param string $url
     *
     * @return \stdClass
     */
    private function jsonFetch($method, $url)
    {
        $response = $this->guzzleClient->request($method, $this->constructUrl($url));

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get full api uri
     *
     * @param string $url
     *
     * @return string
     */
    private function constructUrl($url)
    {
        return rtrim($this->getApiUrl(), '/') . '/' . ltrim($url, '/');
    }
}
