<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – MMI Career</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body class="bg-light">
<div class="container py-5 login-container">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="row g-0">
            
          <!-- Left Panel -->
          <div class="col-md-5 gradient-left d-flex flex-column text-white p-4">
            <div class="flex-grow-1 d-flex flex-column justify-content-center text-center">
              <img src="{{ asset('images/logofavwhite.png') }}" alt="Career illustration" class="img-fluid mb-4">
              <h5 class="fw-bold">Unlock Your Career</h5>
              <p class="small">
                Explore opportunities from across the globe to grow, showcase skills,
                gain CV points & get hired by your dream company.
              </p>
            </div>
          </div>

          <!-- Right Panel -->
          <div class="col-md-7 p-5 bg-white">
            @if(request()->has('apply'))
    <div class="alert alert-warning text-center mb-3">
        Please login to apply for this job.
    </div>
@endif
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

            <h3 class="fw-bold mb-4 text-center">WELCOME BACK!</h3>
            <p class="text-center text-muted mb-4">
              Better jobs are waiting. Sign in and find your next move.
            </p>

            {{-- Social OAuth --}}
            <div class="d-grid gap-3 mb-4">
              <a href="{{ route('google.redirect') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2">
                <i class="fab fa-google"></i> Sign in with Google
              </a>
              {{-- <a href="{{ url('/auth/microsoft') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2">
                <i class="fab fa-microsoft"></i> Sign in with Microsoft
              </a> --}}
            </div>

            <div class="position-relative text-center mb-4">
              <span class="divider">or</span>
            </div>

            {{-- Email / Password Login --}}
            <form method="POST" action="{{ route('login') }}">
              @csrf
           

        <div class="mb-3">
    <input type="email" name="email"
           value="{{ old('email') }}"
           class="form-control rounded-pill @error('email') is-invalid @enderror"
           placeholder="Enter Email Address" required autofocus>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 ">
    <input type="password" name="password"
           class="form-control rounded-pill @error('password') is-invalid @enderror"
           placeholder="Enter Password" required>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


              <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                Login
              </button>
            </form>

            <div class="d-flex justify-content-between mt-3 small">
              <a href="{{route('password.forgot')}}" class="text-decoration-none">Forgot Password?</a>
              <a href="{{ route('register.form') }}" class="text-decoration-none">Sign up</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
<script>
  setTimeout(() => {
    document.querySelectorAll(".alert").forEach(el => el.remove());
  }, 4000);
</script>
</html>
