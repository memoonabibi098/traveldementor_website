<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EmailOtp;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    /**
     * Handle registration form submission
     */
    public function store(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'useremail' => 'required|email|unique:adminusers,email',
            'userphone' => ['required', 'string', 'max:50', 'regex:/^[0-9+\-]+$/'],
            'useraddress' => 'nullable|string|max:500',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3000',
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
        ]);

        // 2️⃣ Handle image upload
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/adminusers'), $imageName);
            $picturePath = 'uploads/adminusers/' . $imageName;
        }

        // 3️⃣ Create Admin User
        $admin = AdminUser::create([
            'full_name' => $request->username,
            'email' => $request->useremail,
            'phone' => $request->userphone,
            'address' => $request->useraddress,
            'picture' => $picturePath,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 1,
            'email_verified' => 0,
        ]);

        // 4️⃣ Generate OTP
        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        EmailOtp::create([
            'adminuser_id' => $admin->id,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        try {
            Mail::send([], [], function ($message) use ($request, $otp) {
                $message->to($request->useremail)
                    ->subject('Your Verification Code - Travel de Mentor');

                // Embed main images
                $logo = $message->embed(public_path('images/website_images/email/logo-dark.png'));
                $otp_icon = $message->embed(public_path('images/website_images/email/otp.png'));

                // Embed social icons
                $facebook = $message->embed(public_path('images/website_images/email/facebook.png'));
                $instagram = $message->embed(public_path('images/website_images/email/insta.png'));
                $mail = $message->embed(public_path('images/website_images/email/mail.png'));
                $web = $message->embed(public_path('images/website_images/email/web.png'));

                // Render Blade template
                $html = view('emails.admin-userregistration', [
                    'otp' => $otp,
                    'logo' => $logo,
                    'otp_icon' => $otp_icon,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    'mail' => $mail,
                    'web' => $web
                ])->render();

                $message->html($html);
            });

            // ✅ Log success
            Log::info('OTP email sent successfully to: ' . $request->useremail);
        } catch (\Exception $e) {
            // ❌ Log failure
            Log::error('Failed to send OTP email to: ' . $request->useremail . ' | Error: ' . $e->getMessage());
        }

        // 6️⃣ Redirect to OTP verification page
        return redirect()->route('admin.verify-otp', ['email' => $admin->email])
            ->with('success', 'Registration successful! Please check your email for OTP verification.');
    }

    /**
     * Show OTP verification form
     */
    public function showOtpForm(Request $request)
    {
        return view('dashboard.verify-otp', ['email' => $request->email]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:adminusers,email',
            'otp' => 'required|digits:6',
        ]);

        $user = AdminUser::where('email', $request->email)->first();

        $otpRecord = EmailOtp::where('adminuser_id', '=', $user->id)
            ->where('otp', '=', $request->otp)
            ->where('is_used', '=', 0)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Mark OTP as used
        $otpRecord->update(['is_used' => 1]);

        // Update user's email_verified
        $user->update(['email_verified' => 1]);

        // Redirect to login page
        return redirect()->route('admin.login')->with('success', 'Email verified successfully! You can now login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'useremail' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (! Auth::guard('admin')->attempt([
            'email' => $request->useremail,
            'password' => $request->password,
        ])) {
            return back()->with('error', 'Invalid credentials.');
        }

        $user = Auth::guard('admin')->user();

        if ($user->email_verified == 0) {
            Auth::guard('admin')->logout();
            return back()->with('error', 'Please verify your email first.');
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Login successful!');
    }



    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
