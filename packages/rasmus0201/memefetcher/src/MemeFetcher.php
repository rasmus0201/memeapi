<?php

namespace Bundsgaard\MemeFetcher;

use Bundsgaard\MemeFetcher\Support\GuardMagicGet;
use Bundsgaard\MemeFetcher\Contracts\MemeRepositoryInterface;
use Bundsgaard\MemeFetcher\Repositories\MemeApiRepository;
use Bundsgaard\MemeFetcher\Repositories\GiphyGifApiRepository;
use Bundsgaard\MemeFetcher\Repositories\MemeloadApiRepository;
use Bundsgaard\MemeFetcher\Repositories\GiphyStickerApiRepository;

class MemeFetcher
{
    use GuardMagicGet;

    /**
     * @var MemeRepositoryInterface[]
     */
    protected $repositories = [];

    /**
     * Call underlaying implementations differently
     *
     * @param string $method
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            $this->guardMagicGet($name);

            return $this->{$name};
        }

        $repositories = $this->availableRepositories();

        // Check if valid provider
        if (!isset($repositories[$name])) {
            throw new \Exception('Undefined property: ' . MemeFetcher::class . '::$' . $name);
        }

        // Check if provider is instantiated
        if (isset($this->repositories[$name])) {
            return $this->repositories[$name];
        }

        // Instantiate, save and return provider
        $this->repositories[$name] = app($repositories[$name]);

        return $this->repositories[$name];
    }

    /**
     * Get random meme
     *
     * @return string
     */
    public function random()
    {
        $repositories = $this->availableRepositories();

        $randomRepository = array_rand($repositories);

        return $this->{$randomRepository}->random();
    }

    /**
     * Default available repositories
     *
     * @return MemeRepositoryInterface[]
     */
    protected function availableRepositories()
    {
        return [
            $this->formatRepositoryClass(MemeApiRepository::class) => MemeApiRepository::class,
            $this->formatRepositoryClass(GiphyGifApiRepository::class) => GiphyGifApiRepository::class,
            $this->formatRepositoryClass(MemeloadApiRepository::class) => MemeloadApiRepository::class,
            $this->formatRepositoryClass(GiphyStickerApiRepository::class) => GiphyStickerApiRepository::class,
        ];
    }

    /**
     * Format a repository class name
     *
     * @var string $className
     *
     * @return string
     */
    protected function formatRepositoryClass($className)
    {
        return strtolower(str_replace('Repository', '', class_basename($className)));
    }
}
