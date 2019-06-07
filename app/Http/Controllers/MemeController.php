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
        return '<img src="'.$this->memeFetcher->random().'" alt="Random meme" />';
    }
}
