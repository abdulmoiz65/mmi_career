<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Reset Password — MMI Career</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}"/>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>
<div class="signup-container">
  <div class="promo">
    <img src="{{ asset('images/logofavwhite.png') }}" alt="MMI"/>
    <h2>Reset Your Password</h2>
    <p>Choose a secure password for your account.</p>
  </div>

  <div class="signup-form">
    <h3>Reset Password</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
      </div>
    @endif

    <form action="{{ route('password.reset') }}" method="POST">
      @csrf
      {{-- we expect password_reset_email in session; still include hidden input for belt-and-suspenders --}}
      <input type="hidden" name="email" value="{{ session('password_reset_email') }}">

      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary-gradient w-100">Update Password</button>
    </form>
    <div class="mt-3">
      <a href="{{ route('login.form') }}">Back to login</a>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
