<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\SignUpService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    protected $signupService;

    public function __construct(SignUpService $signupService)
    {
        $this->signupService = $signupService;
    }

    public function index()
    {
        try {
            $city  = $this->signupService->getAllCities();
            $field = $this->signupService->getAllFields();
            return view('Register', compact('city', 'field'));
        } catch (Exception $e) {
            Log::error('Failed to register: ' . $e->getMessage());
            return ApiResponse::error('Failed to register', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = $this->signupService->signup($request->all());

            return redirect()->back()->with('modal', 'ChÃºc má»«ng báº¡n Ä‘Ã£ Ä‘Äƒng kÃ½ táº¡o tÃ i khoáº£n thÃ nh cÃ´ng. ChÃºng tÃ´i sáº½ liÃªn há»‡ vá»›i báº¡n trong 24h - 48h ngay sau khi pháº§n má»m Ä‘Æ°á»£c táº¡o. Má»i liÃªn há»‡ vui lÃ²ng liÃªn há»‡ Hotline: 0981.185.620 hoáº·c truy cáº­p website: aicrm.vn. Xin cáº£m Æ¡n');
        } catch (Exception $e) {
            Log::error('Failed to signup: ' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()])->withInput();
        }
    }

    public function checkAccount(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');

        $phoneExists = User::where('role_id', 1)
            ->where('phone', $phone)
            ->exists();

        $emailExists = User::where('role_id', 1)
            ->where('email', $email)
            ->exists();

        return response()->json(['phone_exists' => $phoneExists, 'email_exists' => $emailExists]);
    }
}
