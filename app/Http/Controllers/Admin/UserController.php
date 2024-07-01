<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function getUserByRole($role){
        try {
            $user = $this->userService->getUserByRole($role);
           // return view('', compact('user'));
       } catch (Exception $e) {
           Log::error('Failed to fetch products: ' . $e->getMessage());
           return ApiResponse::error('Failed to fetch products', 500);
       }
    }
}
