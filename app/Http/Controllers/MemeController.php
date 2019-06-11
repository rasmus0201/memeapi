<?php

namespace App\Http\Controllers;

use Bundsgaard\MemeFetcher\MemeFetcher;

class MemeController extends Controller
{
    /**
     * @var MemeFetcher $memeFetcher
     */
    private $memeFetcher;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemeFetcher $memeFetcher)
    {
        $this->memeFetcher = $memeFetcher;
    }

    /**
     * Get a random meme
     */
    public function index()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->random())]);
    }

    /**
     * Get a meme
     */
    public function get($url)
    {
        $url = urldecode($url);

        try {
            $host = parse_url($url)['host'];

            if (!in_array($host, [
                'cdn.memeload.us',
                'i.redd.it',
                'i.giphy.com',
                'i.imgur.com',
            ])) {
                throw new \Exception('Meme host not allowed');
            }
        } catch (\Exception $e) {
            die('404 - That\'s an error. The requested url was not found. That\'s all we know.');
        }

        return '<img src="' . $url . '" alt="Random meme" />';
    }

    /**
     * Get a random meme from memeapi
     */
    public function memeapiRandom()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->memeapi->random())]);
    }

    /**
     * Get a random meme from memeloadapi
     */
    public function memeloadapiRandom()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->memeloadapi->random())]);
    }

    /**
     * Get a random gif from giphy
     */
    public function giphyapiRandom()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->giphyapi->random())]);
    }
}
