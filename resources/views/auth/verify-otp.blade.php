<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Verify OTP — MMI Career</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}"/>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>
<div class="signup-container">
  <div class="promo">
    <img src="{{ asset('images/logofavwhite.png') }}" alt="MMI"/>
    <h2>Verify One-Time Code</h2>
    <p>Enter the 6-digit code we sent to your email.</p>
  </div>

  <div class="signup-form">
    <h3>Enter OTP</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
      </div>
    @endif

    <form action="{{ route('password.verifyOtp') }}" method="POST">
      @csrf
      {{-- email is required so we know which account --}}
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', session('password_reset_email')) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">OTP</label>
        <input type="text" name="otp" class="form-control" maxlength="6" required placeholder="123456">
      </div>

      <button type="submit" class="btn btn-primary-gradient w-100">Verify OTP</button>
    </form>

    <div class="mt-3">
      <a href="{{ route('password.forgot') }}">Resend OTP</a> |
      <a href="{{ route('login.form') }}">Back to login</a>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
