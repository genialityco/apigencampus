<?php

namespace App\Traits;

use Spatie\ResponseCache\Facades\ResponseCache;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache()
    {   
        // ResponseCache::clear();
        self::store(function () {
            ResponseCache::clear();
        });

        self::update(function () {
            ResponseCache::clear();
        });

        self::destroy(function () {
            ResponseCache::clear();
        });
    }
}

