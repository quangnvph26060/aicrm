<?php

namespace App\Services;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * Summary of AdminService
 */
class AdminService
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getUserById(int $id): User
    {
        Log::info("Fetching user with ID: $id");
        $user = $this->user->find($id);
        if (!$user) {
            Log::warning("User with ID: $id not found");
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }

    public function updateUser(int $id, array $data): User
    {
        DB::beginTransaction();
        try {
            $admin = $this->getUserById($id);
            Log::info("Updating user with ID: $id");
            $admin->update($data);
            DB::commit();
            return $admin;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update user: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Summary of getStaff
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getStaff(): \Illuminate\Database\Eloquent\Collection
    {
        DB::beginTransaction();
        try {
            $admin = $this->user->where('role_id', 2)->get();
            DB::commit();
            return $admin;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to  staff: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Summary of addStaff
     */
    public function addStaff($data):User
    {
        DB::beginTransaction();
        try {
            $admin = $this->user->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'role_id' => 2,
                'status' => 'active'
            ]);
            DB::commit();
            return $admin;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to add staff: {$e->getMessage()}");
            throw $e;
        }
    }

    public function deleteStaff(int $id): void
    {
        DB::beginTransaction();
        try {
            $staff = $this->getUserById($id);
            $staff->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete staff: {$e->getMessage()}");
            throw new Exception('Failed to delete staff');
        }
    }

}

