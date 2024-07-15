<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\AdminService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuperAdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getSuperAdminInfor($id)
    {
        try {
            $sa = $this->adminService->getUserById($id);
            return view('sa.profile.detail', compact('sa'));
        } catch (Exception $e) {
            Log::error('Failed to fetch super admin info: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch super admin info', 500);
        }
    }

    public function updateSuperAdminInfo(Request $request, $id)
    {
        try {
            $sa = $this->adminService->updateUser($id, $request->all());
            $authUser = session('authUser');
            $authUser->name = $sa->name;
            $authUser->email =  $sa->name;
            $authUser->user_info->img_url = $sa->user_info->img_url;
            session(['authUser' => $authUser]);
            Log::info('Successfully updated super admin profile');
            session()->flash('success', 'Thay đổi thông tin thành công');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Failed to update admin info: ' . $e->getMessage());
            return ApiResponse::error('Failed to update admin info', 500);
        }
    }
}
