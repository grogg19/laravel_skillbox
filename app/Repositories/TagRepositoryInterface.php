<?php

namespace App\Repositories;

interface TagRepositoryInterface
{
    public function tagsCloud();

    public function getAllTagsCount(): int ;
}
