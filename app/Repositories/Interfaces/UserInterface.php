<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserInterface
{
    public function getCount(): int;
    public function getAll(): LengthAwarePaginator;
    public function getUserList(): Collection;

}
