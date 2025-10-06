<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Email Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px;">
  <div style="max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 6px;">
    <h2 style="color:#2c3e50;">Welcome to MAJU Career Portal</h2>
    <p>Dear {{ $user->first_name }},</p>
    <p>Use the following One-Time Password (OTP) to verify your email address:</p>

    <h1 style="text-align:center; letter-spacing: 4px; color:#007bff;">{{ $otp }}</h1>

    <p>This OTP will expire in <strong>10 minutes</strong>.</p>
    <p>If you didn’t create this account, please ignore this email.</p>

    <p style="margin-top:20px;">Thanks,<br>MAJU Career Team</p>
  </div>
</body>
</html>
