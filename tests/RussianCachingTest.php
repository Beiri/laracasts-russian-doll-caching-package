<?php

use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;
use Laracasts\Matryoshka\RussianCaching;

class RusianCachingTest extends TestCase
{
    /** @test */
    function it_caches_the_given_key()
    {
        $post = $this->makePost();

        $cache = new Repository(new ArrayStore);

        $cache = new RussianCaching($cache);

        $cache->put($post, '<div>view fragment</div>');

        $this->assertTrue($cache->has($post->getCacheKey()));
        $this->assertTrue($cache->has($post));
    }
}
