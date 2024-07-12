<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
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

            return redirect()->route('formlogin')->with('success', 'Tài khoản của quý khách đã được gửi về email');
        } catch (Exception $e) {
            Log::error('Failed to signup: ' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()])->withInput();
        }
    }
}
