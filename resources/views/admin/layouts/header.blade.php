<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Career Portal - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
  </head>
  <body>
    <div class="container-scroller">

     <!-- NAV BAR  -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            
          <a class="navbar-brand brand-logo" href=""><img src="{{ asset('images/mmi-logo.png') }}" alt="MMI logo" /></a>
          {{-- that logo is not showing  --}}
          <a class="navbar-brand brand-logo-mini" href=""><img src="{{asset('images/logo.png')}}" alt="MMI logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <!-- <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form> -->
          </div>
          <ul class="navbar-nav navbar-nav-right">
           
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
{{--            
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li> --}}
       
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{asset('images/logo.png')}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-0 text-black"></p>
                </div>
                <i class=" m-3 fa-solid fa-caret-down"></i>
              </a>
<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="dropdown-item" type="submit">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
        </button>
    </form>
</div>


            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- NAVBAR END  -->
      
      <!-- SIDEBAR  -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{asset('images/logo.png')}}" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"></span>
                  <span class="text-secondary text-small"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#hr" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">MMI career</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="hr">
                <ul class="nav flex-column sub-menu">
                
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobs.create') }}">Add Jobs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobs.index')}}">View Jobs</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pages.view_applications')}}">View Applications</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pages.shortlisted')}}">View Shortlisted</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.pages.rejected')}}">View Rejected Applications</a>
                  </li>

                  
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.pages.archived')}}">View Archived Applications</a>
                  </li>


                </ul>
              </div>
            </li>

            @auth('admin')
              @if(auth('admin')->user()->role === 'super_admin')
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Portal Admins</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                  </a>
                  <div class="collapse" id="admin">
                    <ul class="nav flex-column sub-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.pages.create_admin')}}">Create admins</a>
                        <a class="nav-link" href="{{route('admin.pages.view_admin')}}">View admins</a>
                      </li>
                    </ul>
                  </div>
                </li>
              @endif
            @endauth

            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- SIDEBAR END  -->

        <div class="main-panel">