<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function countUsers(): int
    {
        return User::all()->count();
    }

    public function getUsersFromDB(): Collection
    {
        return User::withCount([
            'posts',
            'posts as comments_count' => function ($query) {
                $query->join('comments', 'comments.post_id', '=', 'posts.id');
            },
        ])->where('id', '>' ,150)->where('id', '<' , 500)->get();
    }
############## With  cache ################

    public function countUsersFromCache(): int
    {
        return Cache::rememberForever('count', function () {
            return $this->countUsers();
        });
    }

    public function getUsersFromCache(): Collection
    {
        return Cache::rememberForever('users', function () {
            return $this->getUsersFromDB();
        });
    }
}
