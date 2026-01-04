<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class OtpService
{
    /**
     * Send OTP to the specified phone number.
     * Currently simulates sending by logging to Laravel log.
     *
     * @param string $phone
     * @param string $otp
     * @return void
     */
    public function send(string $phone, string $otp): void
    {
        // Simulate sending SMS/WhatsApp
        // In production, integrate with Fonnte/Twilio here
        
        $message = "D'Lima Coffee: Kode OTP reset password Anda adalah {$otp}. Berlaku selama 5 menit.";
        
        Log::info("OTP_SENT_TO_{$phone}: {$otp}");
        Log::info($message);
    }

    /**
     * Generate a numeric OTP.
     *
     * @param int $length
     * @return string
     */
    public function generate(int $length = 6): string
    {
        return (string) random_int(100000, 999999);
    }
}
