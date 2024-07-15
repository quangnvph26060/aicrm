<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class StoreService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllStore(): LengthAwarePaginator
    {
        try {
            return $this->user->where('role_id', 1)->paginate(5);
        } catch (Exception $e) {
            Log::error('Failed to fetch stores: ' . $e->getMessage());
            throw new Exception('Failed to fetch stores');
        }
    }

    public function findStoreByID(int $id)
    {
        try {
            return $this->user->find($id);
        } catch (Exception $e) {
            Log::error('Failed to find store info: ' . $e->getMessage());
            throw new Exception('Failed to find store info');
        }
    }
    public function findOwnerByPhone($phone)
    {
        try {
            $staff = $this->user
                ->where('phone', $phone)
                ->where('role_id', 1)
                ->first();
            return $staff;
        } catch (Exception $e) {
            Log::error('Failed to find client profile: ' . $e->getMessage());
            throw new Exception('Failed to find client profile');
        }
    }
}
