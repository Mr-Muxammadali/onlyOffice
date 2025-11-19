<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\True_;

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
        ])->paginate(30);
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

    public function getUserById(int $id): User
    {
        return User::findOrFail($id);
    }
    public function saveTransfer(int $userId, int $sum): void
    {
        User::where('id', $userId)->decrement('balance', $sum);
    }
}
