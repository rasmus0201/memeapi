<?php

namespace Bundsgaard\MemeFetcher;

use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;

class MemeFetcher
{
    /**
     * @var MemeRepositoryInterface $repository
     */
    private $repository;

    /**
     * Constructor
     *
     * @param
     */
    public function __construct(MemeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get random meme
     *
     * @return string
     */
    public function random()
    {
        return $this->repository->random();
    }
}
