<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Services\OtpService;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    // 1. Show Form Input Phone
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Process Phone & Send OTP
    public function sendResetLinkEmail(Request $request) 
    {
        // Note: Function name kept standard Laravel style though we use Phone/OTP
        $request->validate(['noHp' => 'required|numeric|exists:users,noHp']);

        // Rate Limiting Check (Simple impl)
        $recentOtp = DB::table('password_reset_otps')
            ->where('phone', $request->noHp)
            ->where('created_at', '>', Carbon::now()->subMinute())
            ->first();

        if ($recentOtp) {
            return back()->withErrors(['noHp' => 'Tunggu 1 menit sebelum meminta OTP baru.']);
        }

        // Generate OTP
        $otp = $this->otpService->generate(6);
        
        // Save to DB
        DB::table('password_reset_otps')->insert([
            'phone' => $request->noHp,
            'otp' => $otp, // In production consider hashing this
            'expires_at' => Carbon::now()->addMinutes(5),
            'created_at' => Carbon::now()
        ]);

        // Send OTP
        $this->otpService->send($request->noHp, $otp);

        return redirect()->route('password.verify', ['phone' => $request->noHp])
            ->with('status', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    // 3. Show Verify OTP Form
    public function showVerifyForm(Request $request)
    {
        $phone = $request->query('phone');
        return view('auth.verify-otp', compact('phone'));
    }

    // 4. Process OTP Verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|exists:users,noHp',
            'otp' => 'required|numeric'
        ]);

        $record = DB::table('password_reset_otps')
            ->where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau kedaluwarsa.']);
        }

        // OTP Valid! Create a secure token for the reset page
        // Simple approach: Signed URL or Session. We'll use Session for simplicity in this flow.
        session(['verified_phone_for_reset' => $request->phone]);
        
        // Clean up used OTP
        DB::table('password_reset_otps')->where('id', $record->id)->delete();

        return redirect()->route('password.reset');
    }

    // 5. Show Reset Password Form
    public function showResetForm()
    {
        if (!session('verified_phone_for_reset')) {
            return redirect()->route('login')->with('error', 'Sesi kedaluwarsa. Silakan ulangi proses.');
        }
        return view('auth.reset-password');
    }

    // 6. Process Reset Password
    public function reset(Request $request)
    {
        $phone = session('verified_phone_for_reset');
        if (!$phone) {
             return redirect()->route('login')->with('error', 'Sesi tidak valid.');
        }

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('noHp', $phone)->first();
        
        if (!$user) {
             return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        // Invalidate session to prevent reuse
        session()->forget('verified_phone_for_reset');

        // Optional: Login the user directly? Or redirect to login.
        // Let's redirect to login for security flow.
        return redirect()->route('login')->with('status', 'Password berhasil direset! Silakan login.');
    }
}
