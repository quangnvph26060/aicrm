<?php

namespace App\Http\Controllers;

use App\Events\CustomerLogin;
use App\Models\User;
use App\Models\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $otp = rand(100000, 999999);
            $otpRecord = OTP::where('user_id', $user->id)->first();
            if ($otpRecord) {
                // Nếu đã tồn tại bản ghi OTP, cập nhật mã OTP và thời gian hết hạn
                $otpRecord->update([
                    'otp' => $otp,
                    'expires_at' => Carbon::now()->addMinutes(5)
                ]);
            } else {
                // Nếu chưa có bản ghi OTP, tạo bản ghi mới
                OTP::create([
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'expires_at' => Carbon::now()->addMinutes(5)
                ]);
            }

            // Gửi email OTP
            event(new CustomerLogin($user, $otp));

            return redirect()->route('verify-otp');
        } else {
            return back()->withErrors(['email' => 'Thông tin không hợp lệ']);
        }
    }

    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);
        $user = Auth::user();
        if(!$user)
        {
            return redirect()->route('login');
        }
        $otpRecord = OTP::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->first();
        if ($otpRecord) {
            $currentTimestamp = Carbon::now()->timestamp;
            $expiresAtTimestamp = Carbon::parse($otpRecord->expires_at)->timestamp;
            if ($expiresAtTimestamp > $currentTimestamp) {
                // Mã OTP hợp lệ và chưa hết hạn
                session()->put('verify_otp_confirm', true);
                return redirect()->route('home');
            } else {
                // Mã OTP đã hết hạn
                return back()->withErrors(['otp' => 'OTP has expired']);
            }
        } else {
            // Mã OTP không hợp lệ
            return back()->withErrors(['otp' => 'OTP is invalid or has expired']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
