<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ZaloOa;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ZaloController extends Controller
{
    public function index()
    {
        $connectedApps = ZaloOa::all();

        return view('superadmin.zalo.oa', compact('connectedApps'));
    }

    public function handleCallback(Request $request)
    {
        $code = $request->input('code');
        $client = new Client();

        try {
            $response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
                'form_params' => [
                    'app_id' => env('ZALO_APP_ID'),
                    'app_secret' => env('ZALO_APP_SECRET'),
                    'code' => $code,
                    'grant_type' => 'authorization_code'
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['access_token']) && isset($body['refresh_token'])) {
                $accessToken = $body['access_token'];
                $refreshToken = $body['refresh_token'];

                $oaResponse = $client->get('https://openapi.zalo.me/v2.0/oa/getoa', [
                    'headers' => [
                        'access_token' => $accessToken
                    ],
                ]);

                $oaData = json_decode($oaResponse->getBody(), true)['data'];

                Log::info('OA Data', ['oa_data' => $oaData]);

                // Disable all other OA
                ZaloOa::query()->update(['is_active' => 0]);

                ZaloOa::updateOrCreate(
                    ['oa_id' => $oaData['oa_id']],
                    [
                        'name' => $oaData['name'],
                        'access_token' => $accessToken,
                        'refresh_token' => $refreshToken,
                        'package_valid_through_date' => Carbon::createFromFormat('d/m/Y', $oaData['package_valid_through_date'])->format('Y-m-d'),
                        'is_active' => 1 // Activate this OA
                    ]
                );

                Log::info('Zalo OA connected successfully.', ['oa_id' => $oaData['oa_id'], 'name' => $oaData['name']]);

                return redirect()->route('super.zalo.zns')->with('success', 'Kết nối Zalo OA thành công');
            } else {
                throw new Exception('Failed to retrieve access token');
            }
        } catch (Exception $e) {
            Log::error('Failed to handle Zalo callback: ' . $e->getMessage());
            return redirect()->route('super.zalo.zns')->with('error', 'Kết nối Zalo OA thất bại');
        }
    }

    public function getAccessTokenForOa($oaId)
    {
        $oa = ZaloOa::where('oa_id', $oaId)->first();

        if (!$oa) {
            return response()->json(['error' => 'OA not found'], 404);
        }

        $client = new Client();
        $refreshToken = $oa->refresh_token;
        $secretKey = env('ZALO_APP_SECRET');
        $appId = env('ZALO_APP_ID');

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

            if (isset($body['access_token']) && isset($body['refresh_token'])) {
                // Update access token and refresh token for the current OA
                $oa->update([
                    'access_token' => $body['access_token'],
                    'refresh_token' => $body['refresh_token'],
                ]);

                // If the OA is not active, activate it
                if ($oa->is_active != 1) {
                    ZaloOa::query()->update(['is_active' => 0]); // Deactivate all other OAs
                    $oa->is_active = 1;
                    $oa->save();
                }

                return response()->json([
                    'access_token' => $body['access_token'],
                    'refresh_token' => $body['refresh_token']
                ]);
            } else {
                return response()->json(['error' => 'Failed to retrieve tokens'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateOaStatus(Request $request, $oaId)
    {
        // Retrieve the OA by ID
        $oa = ZaloOa::where('oa_id', $oaId)->first();

        if ($oa) {
            // Set all OA to inactive
            ZaloOa::query()->update(['is_active' => 0]);

            // Activate the new OA
            $oa->is_active = 1;
            $oa->save();

            // Return the name of the newly activated OA
            return response()->json([
                'success' => true,
                'message' => 'Trạng thái OA đã được cập nhật',
                'active_oa_name' => $oa->name
            ]);
        }

        return response()->json(['success' => false, 'message' => 'OA không tồn tại']);
    }

    public function getActiveOaName()
    {
        $activeOa = ZaloOa::where('is_active', 1)->first();

        if ($activeOa) {
            return response()->json(['active_oa_name' => $activeOa->name]);
        }

        return response()->json(['active_oa_name' => 'Chưa có OA nào được kích hoạt']);
    }
}
