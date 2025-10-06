@include('admin.layouts.header')

<div class="content-wrapper p-4">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
    </div>
  @endif

  <div class="bg-primary p-4 text-white mb-4 rounded shadow-sm">
    <h4 class="mb-0">Welcome, </h4>
    <small>Admin Dashboard Overview</small>
  </div>

    <div class="row g-4">
      


        <div class="col-md-3 mb-2">
          <div class="card border-primary shadow-sm text-center p-1">
            <div class="card-body">
              <i class="bi bi-briefcase-fill text-primary" style="font-size: 2rem;"></i>
              <h6 class="mt-2 text-primary fw-bold">Total Jobs</h6>
              <h2 class="text-danger">{{ $jobsCount }}</h2>
              <a href="{{route('jobs.create')}}" class="btn btn-danger btn-sm mb-2">Add Job</a><br>
              <a href="{{route('jobs.index')}}" class="btn btn-primary btn-sm">View Jobs</a>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-2">
          <div class="card border-primary shadow-sm text-center p-1">
            <div class="card-body">
              <i class="bi bi-briefcase-fill text-primary" style="font-size: 2rem;"></i>
              <h6 class="mt-2 text-primary fw-bold">Total Applications</h6>
              <h2 class="text-danger">{{ $applicationsCount }}</h2>
              <a href="{{route('admin.pages.view_applications')}}" class="btn btn-primary btn-sm">View Applications</a>
            </div>
          </div>
        </div>


        <div class="col-md-3 mb-2">
          <div class="card border-primary shadow-sm text-center p-1">
            <div class="card-body">
              <i class="bi bi-briefcase-fill text-primary" style="font-size: 2rem;"></i>
              <h6 class="mt-2 text-primary fw-bold">Shortlisted Applications</h6>
              <h2 class="text-danger">{{ $shortlistedCount }}</h2>
              <a href="{{route('admin.pages.shortlisted')}}" class="btn btn-primary btn-sm">View shortlisted </a>
            </div>
          </div>
        </div>


      
        <div class="col-md-3 mb-2">
          <div class="card border-primary shadow-sm text-center p-1">
            <div class="card-body">
              <i class="bi bi-briefcase-fill text-primary" style="font-size: 2rem;"></i>
              <h6 class="mt-2 text-primary fw-bold">Total Users</h6>
              <h2 class="text-danger">{{ $usersCount }}</h2>
            </div>
          </div>
        </div>
    </div>



<div class="row mt-4">
  <div class="col-md-12">
    <div class="card shadow-sm border-primar  y">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Recent Applications</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
  <table class="table table-hover mb-0">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Applicant Name</th>
        <th>Email</th>
        <th>Job Type</th>
        <th>Desired Salary</th>
        <th>Shortlisted</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentApplications as $index => $app)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $app->name }}</td>
          <td>{{ $app->email ?? '—' }}</td>
          <td>{{ ucfirst(str_replace('_',' ',$app->job_type)) }}</td>
          <td>{{ $app->salary_desired ?? '—' }}</td>
          <td>
            @if($app->is_shortlisted)
              <span class="badge bg-success">Yes</span>
            @else
              <span class="badge bg-danger">No</span>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted">No applications yet</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
  </div>
</div>
  </div>
</div>



</div>

@include('admin.layouts.footer')
