<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ZaloController extends Controller
{
    public function index()
    {
        // $accessToken = $this->getAccessToken();
        // dd($accessToken);
        $accessToken = '8T1BBKUzINudq40gHBL9VY3NHIrQ-YOyUTz5AtlOJsHms0CmJhbDD76h0ITAZWDyUfnMHb-_71TXZMunHPuWDtMVJ3OIWqSNSUuv71F9G0npoWiV4VPs6YsE1ZGca70JCO0o0bU3KW9wXJmMVuXyC4IJTYD6edqcIuCAFaMUUIn4-oGH9-19FpYDIsWjZqWp68yeCocxI3PDdqSjKe0S7JIJS1WwZtuNDeinBGk_NZuysmeGAUC3C3p5IZi7r3WfFj9JEoUm0sm9esXH1AawO6AQCJjludmJTjGABXBH03Gbw54X2_Gj5pxeM1GmyJioCkDc1b_1SH98mJmOJVzk6sF23J5GxayARDmoDsl5Jnnq-nzDHlnnQtVeBcrdn69vLFrgBqNR4Zvyu1eCVy1DLsxR56rOGaTKLJfYGQj7V0';
        $secretKey = 'LICH82nioSW8a3RLVG2X';
        $client = new Client();

        try {
            $response = $client->get('https://openapi.zalo.me/v2.0/oa/getoa', [
                'headers' => [
                    'access_token' => $accessToken, // Có thể cần kiểm tra xem tên header có chính xác không
                    'refresh_token' => $secretKey,     // Có thể cần kiểm tra xem tên header có chính xác không
                ],
            ]);
            // dd($response);
            $connectedApps = json_decode($response->getBody(), true);

            // Debug thông tin phản hồi
            Log::info('API Response:', $connectedApps);

            // Check if 'data' key exists
            if (isset($connectedApps['data'])) {
                // Format the date if it exists
                if (isset($connectedApps['data']['package_valid_through_date'])) {
                    $connectedApps['data']['package_valid_through_date'] = Carbon::createFromFormat('d/m/Y', $connectedApps['data']['package_valid_through_date'])->format('Y-m-d');
                }
            } else {
                $connectedApps['data'] = [];
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('API Request Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            $connectedApps['data'] = [];
        }

        return view('superadmin.zalo.oa', compact('connectedApps'));
    }
    public function refreshAccessToken($refreshToken, $secretKey, $appId)
    {
        $client = new Client();
        try {
            $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
                'headers' => [
                    'secret_key' => $secretKey
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'app_id' => $appId
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info($body);
            if (isset($body['access_token'])) {
                // Lưu access_token mới vào cache
                Cache::put('access_token', $body['access_token'], 86400); // 86400 = 24h
                return $body['access_token'];
            } else {
                throw new \Exception('Failed to refresh access token');
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            Log::error('Failed to refresh access token: ' . $e->getMessage());
            throw new \Exception('Failed to refresh access token');
        }
    }
    public function getAccessToken()
    {
        // Lấy access_token từ cache
        $accessToken = Cache::get('access_token');

        // Nếu không có access_token trong cache, làm mới nó
        if (!$accessToken) {
            $refreshToken = 'm4L1C8f8FId6HKetYK0zAS52Jp2N9K5zYdGmDhOr6actKcuda3TlLRnE6WYcDIGGcN46LfKIS1pPL4H-aWXaCvvr5MlV42PnvHm3FALu5MMyDnK6wJjX5jjjGN3BBK8fXorVOgyfVNcKNKjedbrcBQGmTpIuLNqjbHLQHDf1AY-QFXnlrq8Q2VWdAb3j91T8squc5T98Emtl10z2xqiaM-r60nVSGpq9oY1ERjL0Np3Q47uXu7HzEQ4sIcMFTLGZmmWXL9O90n28SNHxkGnZDV517s_QFcqB-tDXIEqk5JFcKs58oJHL6jT4OMt_46GttH5PIj9fMGFGQoj5aJKL1wPh2H-u3Y8Qh4ahU90l936w8XbziI8bFvDI1L2Q2n8EW4ySORz3Fn7n8qjsxqbBPdTuDKGeZ5upAm';
            $secretKey = 'LICH82nioSW8a3RLVG2X';
            $appId = '632881483670360761';
            $accessToken = $this->refreshAccessToken($refreshToken, $secretKey, $appId);
        }

        // Thay đổi để lấy refresh token từ cache nếu cần
        $refreshToken = 'your_refresh_token_here'; // Thay thế bằng refresh token thực tế nếu cần

        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ]);
    }
}
