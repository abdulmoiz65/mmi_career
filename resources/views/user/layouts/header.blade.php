<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMI Career Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mmi_career_style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
    <script src="{{asset('js/auto_hide.js')}}"></script>
</head>
<body>
<!-- Navigation -->
<nav class="navbar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/mmi-logo.png') }}" alt="MMI Logo" class="me-2" >
            
        </a>

        <div class="ms-auto d-flex align-items-center">
            {{-- When user is **not** logged in --}}
            @guest
                <a href="{{ route('login.form') }}" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            @endguest

            {{-- When user **is** logged in --}}
            @auth
                <div class="dropdown">
                    <button class="btn btn-login dropdown-toggle" type="button"
                            id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ auth()->user()->first_name ?? auth()->user()->email ?? '' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><hr class="dropdown-divider"></li>
                        <li>
                           <form action="{{ route('logout') }}" method="POST" onsubmit="this.querySelector('button').disabled=true;">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

@if(session('success') || session('error'))
<!-- Flash Message Modal -->
<div class="modal fade" id="flashModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header 
           {{ session('success') ? 'bg-success text-white' : 'bg-danger text-white' }}">
        <h5 class="modal-title mb-0">
          {{ session('success') ? 'Success' : 'Error' }}
        </h5>
      </div>
      <div class="modal-body fs-6">
        {{ session('success') ?? session('error') }}
      </div>
    </div>
  </div>
</div>
@endif


    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <h1>Welcome to the Jobs page of MMI</h1>
            <p>Explore exciting opportunities and find your dream career with us.</p>
        </div>
    </section>

        <!-- Stats Section -->
    {{-- <section class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">200+</div>
                        <div class="stat-label">Staff Members</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Faculty Members</div>
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">25+</div>
                        <div class="stat-label">Years of Excellence</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Programs</div>
                    </div>
                </div>
               
            </div>
        </div>
    </section> --}}



    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
          <form method="GET" action="{{ route('user.index') }}" class="search-form">
    <div class="row g-3">
        <div class="col-md-8">
            <select class="form-select" name="job_type" onchange="this.form.submit()">
                <option value="">All Job Types</option>
                <option value="permanent_faculty" {{ request('job_type') == 'permanent_faculty' ? 'selected' : '' }}>Permanent Faculty</option>
                <option value="visiting_faculty" {{ request('job_type') == 'visiting_faculty' ? 'selected' : '' }}>Visiting Faculty</option>
                <option value="staff" {{ request('job_type') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-search w-100">
                <i class="fas fa-search me-2"></i>Search
            </button>
        </div>
    </div>
</form>


        </div>
    </section>

