<?php

namespace App\Http\Controllers\Http\Controllers\View;

use App\Http\Controllers\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    /**
     * @return View
     */
    public function getUsersFromDB(): View
    {
        $countUsers = $this->userService->countUsers();
        $users = $this->userService->getUsersFromDB();
        return view('welcome', compact('countUsers', 'users'));
    }
    /**
     * @return View
     */
    public function getUsersFromCache(): View
    {
        $countUsers = $this->userService->countUsersFromCache();
        $users = $this->userService->getUsersFromCache();
        return view('welcome', compact('countUsers', 'users'));
    }
}
