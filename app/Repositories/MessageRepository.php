<?php

namespace App\Repositories;

use App\Models\Message;
/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository
{
    /**
    * @return mixed
    */
    public static function listMessages()
    {
        return Message::latest()->get();
    }

    /**
     * @param $data
     */
    public static function createMessage($data)
    {
        Message::create($data);
    }
}
