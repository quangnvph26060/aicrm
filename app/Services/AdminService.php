<?php

namespace App\Services;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserService
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

}

