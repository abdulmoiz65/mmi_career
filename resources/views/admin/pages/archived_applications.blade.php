@include('admin.layouts.header')

<div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <h4 class="card-title mb-3">Archived Applications</h4>

          {{-- ✅ Messages --}}
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <div class="text-muted">Total: {{ $applications->total() }}</div>
        </div>

        <!-- 🔍 Filters -->
        <form method="get" class="row gy-2 gx-2 align-items-end mb-3">
          <div class="col-md-3">
            <label class="form-label">Search</label>
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name, Email, Contact">
          </div>
          <div class="col-md-3">
            <label class="form-label">Job Type</label>
            <select name="job_type" class="form-select">
              <option value="">All</option>
              <option value="permanent_faculty" @selected(request('job_type')==='permanent_faculty')>Permanent Faculty</option>
              <option value="visiting_faculty" @selected(request('job_type')==='visiting_faculty')>Visiting Faculty</option>
              <option value="staff" @selected(request('job_type')==='staff')>Staff</option>
            </select>
          </div>
          <div class="col-md-2 d-grid">
            <button class="btn btn-primary">Filter</button>
          </div>
          <div class="col-md-2 d-grid">
            <a href="{{ route('admin.pages.archived') }}" class="btn btn-secondary">Reset</a>
          </div>
        </form>

        <!-- 📋 Archived Applications Table -->
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th>Job Type</th>
              <th>Highest Degree</th>
              <th>Salary Desired</th>
              <th>Archived On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($applications as $app)
              <tr>
                <td>
                  <div class="fw-semibold">{{ $app->name }}</div>
                  @if($app->contact)
                    <small class="text-muted">{{ $app->contact }}</small>
                  @endif
                </td>
                <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_',' ', $app->job_type)) }}</span></td>
                <td>
                  {{ $app->permanentFaculty->highest_degree
                      ?? $app->visitingFaculty->highest_degree
                      ?? $app->staff->highest_degree
                      ?? '-' }}
                </td>
                <td>{{ $app->salary_desired ?? '-' }}</td>
                <td>{{ $app->updated_at->format('d M, Y h:i A') }}</td>
                <td>
                  <a href="{{ route('admin.pages.view_application_show', $app->id) }}" class="btn btn-primary btn-sm">
                    View
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center">No archived applications found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $applications->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')
