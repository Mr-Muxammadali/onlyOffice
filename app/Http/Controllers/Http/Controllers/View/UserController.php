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
    public function index(): View
    {
        $users = $this->userService->getAll();
        $countUsers = $this->userService->countUsersFromDB();
        return view('welcome', compact('countUsers', 'users'));
    }

    /**
     * @return View
     */
    public function getUsersFromDB(): View
    {
        $users = $this->userService->getUsersFromDB();
        $countUsers = $this->userService->countUsersFromDB();
        return view('welcome', compact('countUsers', 'users'));
    }
    /**
     * @return View
     */
    public function getUsersFromCache(): View
    {
        $users = $this->userService->getUsersFromCache();
        $countUsers = $this->userService->countUsersFromCache();
        return view('welcome', compact('countUsers', 'users'));
    }
}
