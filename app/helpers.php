<?php

if (! function_exists('push_all')) {

    /**
     * @param null $title
     * @param null $text
     * @param null $articleLink
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function push_all($title = null, $text = null, $articleLink = null)
    {
        if (is_null($title) || is_null($text) || is_null($articleLink)) {
            return app(\App\Services\PushAll::class);
        }
        return app(\App\Services\PushAll::class)->send($title, $text, $articleLink);
    }
}
