<?php


namespace App\Repositories;

/**
 * Interface MessageType
 * @package App\Repositories
 */
interface MessageType
{
    public function listMessages();

    public function createMessage(array $data);
}
