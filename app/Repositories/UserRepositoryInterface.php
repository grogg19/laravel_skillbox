<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAuthorManiac();

    public function getAllUsersCount(): int;
}
