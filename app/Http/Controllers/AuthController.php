<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Trim email to remove extra spaces
        $request->merge(['email' => trim($request->email)]);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via SMTP and log
        $this->sendOtpMail($user, $otp);

        // Redirect to OTP form with email in query parameter
        return redirect()->route('otp.form', ['email' => $user->email]);
    }

    // Show OTP form
    public function showOtpForm(Request $request)
    {
        $email = $request->query('email'); // get email from URL
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Email is required to verify OTP.']);
        }
        return view('auth.otp', compact('email'));
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        // Use loose comparison to avoid type mismatch
        if ($user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        $user->update([
            'is_verified'    => true,
            'otp'            => 0,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('login')->with('success', 'OTP verified! Please login.');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if (!$user->is_verified) {
            return redirect()->route('otp.form', ['email' => $user->email]);
        }

        auth()->login($user);
        return redirect()->route('dashboard');
    }

    // Handle logout
    public function logout(Request $request)
{
    auth()->logout(); // log out the user
    $request->session()->invalidate(); // invalidate session
    $request->session()->regenerateToken(); // regenerate CSRF token

    return redirect('/login'); // redirect to login page
}


    // Helper function to send OTP via SMTP and log
    protected function sendOtpMail(User $user, $otp)
    {
        $mail = new OtpMail($otp);

        // Send via SMTP
        Mail::mailer('smtp')->to($user->email)->send($mail);

        // Log email
        Mail::mailer('log')->to($user->email)->send($mail);
    }
}
