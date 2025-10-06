<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Forgot Password — MAJU Career</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}"/>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>
<div class="signup-container">
  <div class="promo">
    <img src="{{ asset('images/logofavwhite.png') }}" alt="MAJU"/>
    <h2>MAJU Career</h2>
    <p>We will send a one-time code (OTP) to your email to reset your password.</p>
  </div>

  <div class="signup-form">
    <h3>Forgot Password</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
      </div>
    @endif

    <form action="{{ route('password.sendOtp') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Enter your registered email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <button class="btn btn-primary-gradient w-100" type="submit">Send OTP</button>
    </form>

    <div class="mt-3">
      <a href="{{ route('login.form') }}">Back to login</a>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
