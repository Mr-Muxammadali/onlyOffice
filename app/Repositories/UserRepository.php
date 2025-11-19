<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserInterface
{

    public function getCount(): int
    {
        return User::all()->count();
    }

    public function getAll(): LengthAwarePaginator
    {
        return User::withCount([
            'posts',
            'posts as comments_count' => function ($query) {
                $query->join('comments', 'comments.post_id', '=', 'posts.id');
            },
        ])->paginate(15);
    }

    public function getUserList(): Collection
    {
        return User::withCount([
            'posts',
            'posts as comments_count' => function ($query) {
                $query->join('comments', 'comments.post_id', '=', 'posts.id');
            },
        ])->where('id', '>' ,150)->where('id', '<' , 250)->get();
    }
}
