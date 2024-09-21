<?php

namespace Laracasts\Matryoshka;

use Illuminate\Support\Facades\Cache;

class FlushViews
{
    public function handle($request, $next)
    {
        if (app()->environment() === 'local') {
            Cache::tags('views')->flush();
        }

        return $next($request);
    }
}
