<?php

namespace App\Helpers;

trait CacheCleanable
{
    public static function bootCacheCleanable()
    {
        static::created(function () {
            cache()->tags(self::$tags)->flush();
        });
        static::updated(function () {
            cache()->tags(self::$tags)->flush();
        });
        static::deleted(function () {
            cache()->tags(self::$tags)->flush();
        });
    }
}
