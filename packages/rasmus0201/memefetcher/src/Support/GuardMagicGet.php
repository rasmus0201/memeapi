<?php

namespace Bundsgaard\MemeFetcher\Support;

trait GuardMagicGet
{
    /**
     * Check if property is allowed for magic method __get
     *
     * @param string $name
     *
     * @return void
     *
     * @throws \Exception  If property is private
     * @throws \Exception  If property is protected
     * @throws \Exception  If property is static
     */
    private function guardMagicGet($name)
    {
        $rp = new \ReflectionProperty($this, $name);

        if ($rp->isPrivate()) {
            throw new \Exception('Cannot access private property ' . MemeFetcher::class . '::$' . $name);
        }

        if ($rp->isProtected()) {
            throw new \Exception('Cannot access protected property ' . MemeFetcher::class . '::$' . $name);
        }

        if ($rp->isStatic()) {
            throw new \Exception('Accessing static property ' . MemeFetcher::class . '::$' . $name . ' as non static');
        }
    }
}
