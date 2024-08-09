<?php

namespace App\Services;

use App\Mail\SuperAdmin as MailSuperAdmin;
use App\Mail\UserRegistered;
use App\Models\City;
use App\Models\Config;
use App\Models\Field;
use App\Models\Message;
use App\Models\OaTemplate;
use App\Models\SuperAdmin;
use App\Models\User;
use App\Models\ZaloOa;
use App\Models\ZnsMessage;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SignUpService
{
    protected $user;
    protected $city;
    protected $field;
    protected $superAdmin;
    public function __construct(User $user, City $city, Field $field, SuperAdmin $superAdmin)
    {
        $this->user = $user;
        $this->city = $city;
        $this->field = $field;
        $this->superAdmin = $superAdmin;
    }

    public function signup(array $data)
    {
        DB::beginTransaction();
        try {
            Log::info("Creating new account: {$data['name']}");
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

            $superadmin = $this->superAdmin->first();
            Mail::to($superadmin)->send(new MailSuperAdmin($user, $password));
            Mail::to($data['email'])->send(new UserRegistered($user, $password));

            $accessToken = $this->getAccessToken();
            try {
                $client = new Client();
                $response = $client->post('https://business.openapi.zalo.me/message/template', [
                    'headers' => [
                        'access_token' => $accessToken,
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'phone' => preg_replace('/^0/', '84', $data['phone']),
                        'template_id' => '355330',
                        'template_data' => [
                            'date' => Carbon::now()->format('d/m/Y') ?? "",
                            'name' => $data['name'] ?? "",
                            'order_code' => $user->id,
                            'phone_number' => $data['phone'],
                            'status' => 'Đăng ký thành công'
                        ]
                    ]
                ]);

                $responseBody = $response->getBody()->getContents();
                Log::info("Phản hồi API: " . $responseBody);
                $responseData = json_decode($responseBody, true);
                $status = $responseData['error'] == 0 ? 1 : 0; // 1: Thành công, 0: Thất bại
                $template_id = OaTemplate::where('template_id', '355330')->first()->id;
                // $note = $responseData['message'] ?? '';
                // dd(gettype($note));
                // dd($responseData['message']);

                // dd($responseBody);

                // Lưu thông tin tin nhắn vào cơ sở dữ liệu
                ZnsMessage::create([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'sent_at' => Carbon::now(),
                    'status' => $status,
                    'note' => $responseData['message'],
                    'template_id' => $template_id,
                ]);

                if ($status == 1) {
                    Log::info('Gửi ZNS thành công');
                } else {
                    Log::error('Gửi ZNS thất bại: ' . $response->getBody());
                }
            } catch (Exception $e) {
                Log::error('Lỗi khi gửi tin nhắn: ' . $e->getMessage());

                // Lưu thông tin tin nhắn vào cơ sở dữ liệu khi gặp lỗi
                ZnsMessage::create([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'sent_at' => Carbon::now(),
                    'status' => 0, // Thất bại
                    'note' => $responseData['message'],
                ]);
            }

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new account: ' . $e->getMessage());
            throw new Exception('Failed to create new account');
        }
    }



    public function refreshAccessToken($refreshToken, $secretKey, $appId)
    {
        $client = new Client();
        try {
            $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
                'headers' => [
                    'secret_key' => $secretKey,
                ],
                'form_params' => [ // Sửa lỗi chính tả
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'app_id' => $appId
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info('Refresh token response: ', $body);

            if (isset($body['access_token'])) {
                Cache::put('access_token', $body['access_token'], 86400); //86400 = 24h
                if (isset($body['refresh_token'])) {
                    Cache::put('refresh_token', $body['refresh_token'], 7776000); //7776000 = 3 tháng
                }
                return $body['access_token'];
            } else {
                throw new Exception('Failed to refresh access token');
            }
        } catch (Exception $e) {
            Log::error('Failed to refresh access token: ' . $e->getMessage());
            throw new Exception('Failed to refresh access token');
        }
    }

    public function getAccessToken()
    {
        $oa = ZaloOa::where('is_active', 1)->first();

        if (!$oa) {
            Log::error('Không tìm thấy OA nào có trạng thái is_active = 1');
            throw new Exception('Không tìm thấy OA nào có trạng thái is_active = 1');
        }

        $accessToken = $oa->access_token;
        $refreshToken = $oa->refresh_token;

        if (!$accessToken && $refreshToken) {
            $secretKey = env('ZALO_APP_SECRET');
            $appId = env('ZALO_APP_ID');
            $accessToken = $this->refreshAccessToken($refreshToken, $secretKey, $appId);

            // Cập nhật access token mới vào cơ sở dữ liệu
            $oa->update(['access_token' => $accessToken]);
        }

        Log::info('Retrieved access token: ' . $accessToken);
        return $accessToken;
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
