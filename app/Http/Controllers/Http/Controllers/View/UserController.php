<?php

namespace App\Http\Controllers\Http\Controllers\View;

use App\Http\Requests\TransferRequest;
use Illuminate\View\View;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Http\Controllers\Http\Controllers\Controller;
use Throwable;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService(new UserRepository());
    }


    public function index(){
        return view('home');
    }

    public function profile(int $id){
        $user = $this->userService->getUserById($id);
        return view('profile', compact('user'));
    }

    /**
     * @throws Throwable
     */
    public function transfer(TransferRequest $request)
    {
        list($userId, $success) = $this->userService->transfer($request->validated());
        return redirect()
            ->route('profile', $userId)
            ->with('success', $success);
    }



    /**
     * @return View
     */
    public function paginationFromDb(): View
    {
        $users = $this->userService->getAll();
        $countUsers = $this->userService->countUsersFromDB();
        return view('usersWithPagination', compact('countUsers', 'users'));
    }
    public function paginationFromCache(): View
    {
        $users = $this->userService->getAllFromCache();
        $countUsers = $this->userService->countUsersFromCache();
        return view('usersWithPagination', compact('countUsers', 'users'));
    }

    /**
     * @return View
     */
    public function getUsersFromDB(): View
    {
        $source = 'DB';
        $users = $this->userService->getUsersFromDB();
        $countUsers = $this->userService->countUsersFromDB();
        return view('usersList', compact('countUsers', 'users', 'source'));
    }
    /**
     * @return View
     */
    public function getUsersFromCache(): View
    {
        $source = 'Cache';
        $users = $this->userService->getUsersFromCache();
        $countUsers = $this->userService->countUsersFromCache();
        return view('usersList', compact('countUsers', 'users', 'source'));
    }
}
