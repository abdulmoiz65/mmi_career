<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MMI Career Portal – Sign Up</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>

<div class="signup-container">
  <!-- Left Panel -->
  <div class="promo">
    <img src="{{ asset('images/logofavwhite.png') }}" alt="Opportunities">
    <h2>Join and Explore Opportunities at MMI</h2>
    <p>Apply to jobs faster • Get personalized recommendations • Grow your career</p>
  </div>

  <!-- Right Panel -->
  <div class="signup-form">
    <h3>Let’s Get Started</h3>
    <p>Create an account to get recommended jobs and apply instantly.</p>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="User Name" value="{{ old('username') }}" required>
      </div>
      <div class="row g-3">
        <div class="col-md-6 mb-3">
          <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required>
        </div>
        <div class="col-md-6 mb-3">
          <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required>
        </div>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email') }}" required>
      </div>
      <div class="row g-3">
        <div class="col-md-6 mb-3">
          <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>
        <div class="col-md-6 mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>
      </div>

      <button type="submit" class="btn btn-primary-gradient w-100 mb-3">
        Agree &amp; Join
      </button>
    </form>

  <a href="{{ route('google.redirect') }}" class="btn btn-outline-secondary rounded-pill d-flex align-items-center justify-content-center gap-2">
    <i class="fab fa-google"></i> Sign in with Google
  </a>

    <div class="login-link">
      Already have an account?
      <a href="{{ route('login.form') }}">Login</a>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
