<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <input type="email" name="email" value="{{ session('email') }}" readonly required>
    <p>Hello,</p>
    <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
    <p>This code will expire in 10 minutes. Please use it to complete your registration.</p>
    <br>
    <p>Thank you,</p>
    <p><strong>Staff Management Hub</strong></p>
</body>
</html>
