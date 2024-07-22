<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZaloAuthController extends Controller
{
    public function redirectToZalo()
    {
        $app_id = env('ZALO_APP_ID');
        $redirect_uri = env('ZALO_REDIRECT_URI');
        $state = csrf_token(); // Sử dụng CSRF token để bảo mật

        // Tạo URL để người dùng xác thực
        $auth_url = "https://oauth.zaloapp.com/v3/auth?app_id={$app_id}&redirect_uri={$redirect_uri}&state={$state}";

        // Chuyển hướng người dùng đến URL xác thực
        return redirect($auth_url);
    }

    public function handleCallback(Request $request)
    {
        $code = $request->input('code');
        $app_id = env('ZALO_APP_ID');
        $app_secret = env('ZALO_APP_SECRET');

        // Gửi yêu cầu POST để lấy access_token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://oauth.zaloapp.com/v3/access_token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'code' => $code
        ]));

        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $response = json_decode($result, true);
        $access_token = $response['access_token'];

        // Xử lý access_token, ví dụ lưu vào session hoặc database

        return response()->json($response); // Trả về kết quả để kiểm tra
    }
}
