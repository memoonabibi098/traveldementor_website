<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Travel de Mentor - OTP Verification</title>
  </head>
  <body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #ffffff; width:100%;">
    <div style="max-width:600px;  margin:0 auto;">

      <!-- Logo -->
      <div style="text-align:center; padding:10px 0;">
        {{-- <img src="{{ asset('images/website_images/email/logo-dark.png')}}" alt=""> --}}
        <img src="{{ $logo }}" alt="Travel de Mentor Logo">
      </div>

      <!-- OTP Icon -->
      <div style="text-align:center; padding:10px 0;">
        {{-- <img src="{{ asset('images/website_images/email/otp.png')}}" alt=""> --}}
        <img src="{{ $otp_icon }}" alt="OTP Icon">
      </div>

      <!-- Greeting -->
      <div style="padding:10px 0;">
        <p style="margin:0 0 24px 0; color:#2f345b;">Dear Customer!</p>
        <p style="margin:0 0 5px 0; color:#2f345b;">Thank you for registering with <span style="font-weight:bold;">Travel de Mentor</span>.</p>
        <p style="margin:0; color:#2f345b;">Please use the verification code below to complete your account registration:</p>
      </div>

      <!-- OTP Box -->
      <div style="background-color:#c59c3d; text-align:center; padding:10px 0; margin:10px 0; border-radius:5px;">
        <h3 style="margin:0; font-weight:bold; letter-spacing:1.5rem; color:#ffffff;">{{ $otp }}</h3>
        {{-- <h3 style="margin:0; font-weight:bold; letter-spacing:1.2rem; color:#ffffff;">789654</h3> --}}

      </div>

      <!-- Info -->
      <div style="padding:10px 0;">
        <p style="margin:0 0 5px 0; color:#2f345b;">This code is valid for <span style="font-weight:bold;">10 minutes</span>.</p>
        <p style="margin:0 0 24px 0; color:#2f345b;">For your security, please do not share this code with anyone.</p>
        <p style="margin:0 0 5px 0; color:#2f345b;">Best regards,</p>
        <p style="margin:0; color:#2f345b; font-weight:bold;">Team Travel de Mentor</p>
      </div>

      <!-- Footer -->
      <div style="background-color:#c59c3d; padding:15px; text-align:center; border-radius:5px; margin-top:20px;">

        <!-- Social Icons -->
        <div style="margin-bottom:10px; width:100%;">
          <a href="https://www.facebook.com/traveldementorr" style="margin:0 5px; text-decoration:none;">
            {{-- <img src="{{ asset('images/website_images/email/facebook.png')}}" alt="" style="width:5%;"> --}}
                <img src="{{ $facebook }}" alt="Facebook" style="width:5%;">
            </a>
          </a>
          <a href="https://www.instagram.com/trave_ldementor/" style="margin:0 5px; text-decoration:none; ">
            {{-- <img src="{{ asset('images/website_images/email/insta.png')}}" alt="" style="width:5%;"> --}}
               <img src="{{ $instagram }}" alt="Instagram" style="width:5%;">
          </a>
          <a href="mailto:Info@traveldementor.com" style="margin:0 5px; text-decoration:none;">
            {{-- <img src="{{ asset('images/website_images/email/mail.png')}}" alt="" style="width:5%;"> --}}
                <img src="{{ $mail }}" alt="Email" style="width:5%;">
          </a>
          <a href="https://www.traveldementor.com/" style="margin:0 5px; text-decoration:none; ">
            {{-- <img src="{{ asset('images/website_images/email/web.png')}}" alt="" style="width:5%;"> --}}
               <img src="{{ $web }}" alt="Website" style="width:5%;">
          </a>
        </div>

        <!-- Contact Info -->
        <div style="color:#ffffff; font-size:0.8rem; margin-bottom:10px;">
          Need Assistance? We're here to help.
          <a href="https://www.traveldementor.com/contactus" style="font-weight:bold; color:#2f345b; text-decoration:none;">Contact Us.</a>
        </div>

        <!-- Copyright -->
        <p style="margin:0; font-size:0.8rem; color:#ffffff;">© 2024 Travel de Mentor. All rights reserved.</p>
      </div>

    </div>
  </body>
</html>
