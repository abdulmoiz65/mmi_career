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
  <!-- Left Side -->
  <div class="promo">
    <img src="{{ asset('images/logofavwhite.png') }}" alt="MMI"/>
    <h2>Verify Your Email</h2>
    <p>Enter the 6-digit OTP we just sent to <strong>{{ Auth::user()->email }}</strong></p>
  </div>

  <!-- Right Side -->
  <div class="signup-form">
    <h3>Email Verification</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
      </ul>
    </div>
  @endif

    <form action="{{ route('verification.verify') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">One-Time Password</label>
        <input type="text" name="otp" class="form-control" maxlength="6" required placeholder="123456">
      </div>

      <button type="submit" class="btn btn-primary-gradient w-100 mb-3">
        Verify OTP
      </button>
    </form>

    <form action="{{ route('verification.resend') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-outline-secondary w-100 mb-3">
        Resend OTP
      </button>
    </form>

    <div class="login-link">
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
