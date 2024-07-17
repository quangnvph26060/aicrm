<?php

namespace App\Services;

use App\Mail\UserRegistered;
use App\Models\Config;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            return $this->user->where('role_id', 1)->orderByDesc('created_at')->paginate(5);
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

    public function addNewStore(array $data)
    {
        DB::beginTransaction();
        try{
            Log::info("Creating a new account with name: {$data['name']}");
            $password = $this->RenderRandomPassword();

            $hashedPassword = Hash::make($password);
            $store = $this->user->create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'company_name' => $data['company_name'],
                'password' => $hashedPassword,
                'status' => 'active',
                'role_id' => 1,
                'city_id' => $data['city'],
                'tax_code' => $data['tax_code'],
                'store_name' => $data['store_name'],
                'field_id' => $data['field'],
                'domain' => $data['store_domain'],
                'address' => $data['address'],
            ]);
            $config = new Config();
            $config->user_id = $store->id;
            $config->save();

            Mail::to($data['email'])->send(new UserRegistered($store, $password));
            DB::commit();
            return $store;
        }
        catch(Exception $e)
        {
            DB::rollBack();
            Log::error('Failed to add new user: ' .$e->getMessage());
            throw new Exception('Failed to add new user');
        }
    }

    public function RenderRandomPassword()
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';

        $allCharacters = $uppercase . $lowercase . $numbers;
        $password = '';

        // Add one random character from each category to ensure the password contains at least one uppercase letter, one lowercase letter, and one number
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];

        // Add remaining characters randomly from the combined set
        for ($i = 3; $i < 8; $i++) {
            $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        // Shuffle the password to ensure the characters are randomly distributed
        return str_shuffle($password);
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
