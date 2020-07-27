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
        $random = $this->memeFetcher->random();

        if (is_array($random)) {
            return $this->index();
        }

        return redirect()->route('meme.get', ['url' => urlencode($random)]);
    }

    /**
     * Get a random meme for every load
     */
    public function random()
    {
        return '<img src="' . $this->memeFetcher->random() . '" alt="Random meme" style="width:100vw;height:100vh;object-fit:contain;"/>';
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
                'i.redd.it',
                'i.giphy.com',
                'i.imgur.com',
            ])) {
                throw new \Exception('Meme host not allowed');
            }
        } catch (\Exception $e) {
            die('404 - That\'s an error. The requested url was not found. That\'s all we know.');
        }

        return '<img src="' . $url . '" alt="Random meme" style="width:100vw;height:100vh;object-fit:contain;"/>';
    }

    /**
     * Get a random meme from 9gag
     */
    public function ninegagapiRandom()
    {
        ['type' => $type, 'url' => $url] = $this->memeFetcher->ninegagapi->random();

        ?>
            <?php if ($type === 'animated'): ?>
                <video preload="auto" loop="loop" autoplay controls>
                    <source src="<?php echo urldecode($url); ?>" type="video/mp4">
                </video>
            <?php else: ?>
                <picture>
                    <img src="<?php echo urldecode($url); ?>" style="width:100vw;height:100vh;object-fit:contain;">
                </picture>
            <?php endif; ?>
        <?php
    }

    /**
     * Get a random gif from giphy
     */
    public function giphygifapiRandom()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->giphygifapi->random())]);
    }

    /**
     * Get a random sticker from giphy
     */
    public function giphystickerapiRandom()
    {
        return redirect()->route('meme.get', ['url' => urlencode($this->memeFetcher->giphystickerapi->random())]);
    }
}
