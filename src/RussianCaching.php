<?php

namespace Laracasts\Matryoshka;

use Illuminate\COntracts\Cache\Repository as Cache;
use Illuminate\Database\Eloquent\Model;

class RussianCaching
{
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function put($key, $fragment)
    {
        $key = $this->normalizeCacheKey($key);

        return $this
            ->cache
            ->tags('views')
            ->rememberForever($key, function () use ($fragment) {
                return $fragment;
            });
    }

    public function has($key)
    {
        $key = $this->normalizeCacheKey($key);

        return $this
            ->cache
            ->tags('views')
            ->has($key);
    }

    protected function normalizeCacheKey($key)
    {
        if ($key instanceof Model) {
            return $key->getCacheKey();
        }

        return $key;
    }
}
