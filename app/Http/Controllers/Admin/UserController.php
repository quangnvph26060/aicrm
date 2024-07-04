<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\AdminService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    protected $userService;
    protected $adminService;
    public function __construct(UserService $userService, AdminService $adminService)
    {
        $this->userService = $userService;
        $this->adminService = $adminService;
    }

    public function getUserByRole($role)
    {
        try {
            $user = $this->userService->getUserByRole($role);
            // return view('', compact('user'));
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }

    public function index()
    {
        try {
            $user = $this->adminService->getStaff();
            // dd($user);
            return view('Admin.employee.index', compact('user'));
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }

    public function edit($id){
        try{
            $user = $this->adminService->getUserById($id);
            return view('Admin.employee.edit', compact('user'));
        }catch(Exception $e){
            Log::error('Failed to find user: ' . $e->getMessage());
            return ApiResponse::error('Failed to find user', 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $user = $this->adminService->updateUser($id, $request->all());
            return redirect()->route('admin.staff.store')->with('success', 'Update thành công');
        } catch (Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());
            return ApiResponse::error('Failed to update user', 500);
        }
    }

    public function updateadmin(Request $request, $id)
    {
        try {
            $user = $this->adminService->updateUser($id, $request->all());
            $request->session()->regenerate();
            Auth::setUser($user);
            $request->session()->put('authUser', $user);
            return redirect()->route('admin.staff.store')->with('success', 'Update thành công');
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch products', 500);
        }
    }

    public function addForm(){
        return view('Admin.employee.add');
    }
    public function add(Request $request)
    {
        try {
            $user = $this->adminService->addStaff($request->all());
            return redirect()->route('admin.staff.store')->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            Log::error('Failed to add staff: ' . $e->getMessage());
            return ApiResponse::error('Failed to add staff:', 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->adminService->deleteStaff($id);
            return redirect()->route('admin.staff.store')->with('success', 'Xóa thành công');
        } catch (Exception $e) {
            Log::error('Failed to add staff: ' . $e->getMessage());
            return ApiResponse::error('Failed to add staff:', 500);
        }
    }
}
