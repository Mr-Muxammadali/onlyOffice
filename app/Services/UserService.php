<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function __construct(public UserRepository $repository)
    {
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }
    public function countUsersFromDB(): int
    {
        return $this->repository->getCount();
    }

    public function getUsersFromDB(): Collection
    {
            return  $this->repository->getUserList();
    }
############## With  cache ################

    public function countUsersFromCache(): int
    {
        return Cache::rememberForever('count', function () {
            return $this->repository->getCount();
        });
    }

    public function getUsersFromCache(): Collection
    {
        return Cache::rememberForever('users', function () {
            return  $this->repository->getUserList();
        });
    }
}
