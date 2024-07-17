<?php

namespace App\Services;

use App\Mail\UserRegistered;
use App\Models\City;
use App\Models\Config;
use App\Models\Field;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SignUpService
{
    protected $user;
    protected $city;
    protected $field;
    public function __construct(User $user, City $city, Field $field)
    {
        $this->user = $user;
        $this->city = $city;
        $this->field = $field;
    }

    public function signup(array $data)
    {
        DB::beginTransaction();
        try {
            Log::info("Creating new account: {$data['name']}");
            // $this->checkExistingUser($data['phone'], $data['email']);
            $password = $this->RenderRandomPassword();

            $hashedPassword = Hash::make($password);

            $user = $this->user->create([
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
            $config->user_id = $user->id;
            $config->save();
            // dd($user);
            Mail::to($data['email'])->send(new UserRegistered($user, $password));
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new account: ' . $e->getMessage());
            throw new Exception('Failed to create new account');
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
    public function getAllCities()
    {
        try {
            return $this->city->all();
        } catch (Exception $e) {
            Log::error('Failed to fetch all cities: ' . $e->getMessage());
            throw new Exception('Failed to fetch all city');
        }
    }
    public function getAllFields()
    {
        try {
            return $this->field->all();
        } catch (Exception $e) {
            Log::error('Failed to fetch all fields: ' . $e->getMessage());
            throw new Exception('Failed to fetch all field');
        }
    }
}
