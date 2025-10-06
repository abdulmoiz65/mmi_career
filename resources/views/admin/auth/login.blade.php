<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ADMIN - MMI CAREER</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
            <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo text-center">
              <img src="">
            </div>
            <h3 class="text-center text-primary">MMI CAREER!</h3>

            <form class="pt-3" method="POST" action="{{ route('admin.login.submit') }}">
              @csrf
              <div class="form-group">
                <input  name="email" class="form-control form-control-lg"
                       placeholder="Email" value="{{ old('email') }}" required autofocus>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg"
                       placeholder="Password" required>
              </div>

              @error('email')
                <div class="text-danger small mb-2">{{ $message }}</div>
              @enderror

              <div class="mt-3 d-grid gap-2">
                <button type="submit"
                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                  SIGN IN
                </button>
              </div>

              <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" class="form-check-input"> Keep me signed in
                  </label>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
