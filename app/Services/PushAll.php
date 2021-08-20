<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PushAll
{

    private $id;
    private $apiKey;

    protected $url = 'https://pushall.ru/api.php';

    /**
     * @param $apiKey
     * @param $id
     */
    public function __construct($apiKey, $id)
    {
        $this->apiKey = $apiKey;
        $this->id = $id;
    }

    /**
     * @param $title
     * @param $text
     * @param $link
     * @return \Illuminate\Http\Client\Response
     */
    public function send($title, $text, $link)
    {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'title' => $title,
            'text' => $text,
            'url' => $link
        ];

        return Http::asForm()->post($this->url, $data);
    }
}
