<?php


namespace App\Repositories;

/**
 * Interface MessageType
 * @package App\Repositories
 */
interface MessageRepositoryInterface
{
    public function listMessages();

    public function createMessage(array $data);
}
