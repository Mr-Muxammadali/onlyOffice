<?php

namespace App\Http\Controllers\Http\Controllers\Api;

use App\Http\Controllers\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct(public UserService $userService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function countUsers(): JsonResponse
    {
        $countUsers = $this->userService->countUsers();
        return response()->json($countUsers);
    }
    /**
     * @return JsonResponse
     */
    public function getUsersFromDB(): JsonResponse
    {
        $users = $this->userService->getUsersFromDB();
        return response()->json($users);
    }
    /**
     * @return JsonResponse
     */
    public function getUsersFromCache(): JsonResponse
    {
        $users = $this->userService->getUsersFromCache();
        return response()->json($users);
    }
}
