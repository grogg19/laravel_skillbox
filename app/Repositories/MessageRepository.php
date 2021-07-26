<?php

namespace App\Repositories;

use App\Models\Message;
/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository implements MessageRepositoryInterface
{
    /**
    * @return mixed
    */
    public function listMessages()
    {
        return Message::latest()->get();
    }

    /**
     * @param array $data
     */
    public function createMessage(array $data)
    {
        Message::create($data);
    }
}
