@include('admin.layouts.header')

<div class="content-wrapper">

  {{-- Success Message --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif

  {{-- Error Message --}}
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
    </div>
  @endif

  <div class="col-lg-12 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Maju Career Management</h4>

        <div class="d-flex justify-content-end mb-3">
          <a href="{{ route('jobs.create') }}" class="btn btn-gradient-primary btn-sm">Add New Career Post</a>
        </div>

        <p class="card-description">
          Below is a list of all career posts. You can edit or delete them.
        </p>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Title</th>
              <th>Job Type</th>
              <th>Contact</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jobs as $job)
              <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->job_type }}</td>
                <td>{{ $job->contact ?? '—' }}</td>
                <td>
                  <span class="badge bg-{{ $job->status === 'Active' ? 'success' : 'secondary' }}">
                    {{ $job->status }}
                  </span>
                </td>
                <td>{{ $job->created_at ? $job->created_at->format('d M Y') : '—' }}</td>
                <td>
                  <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this post?');">
                        Delete
                      </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center">No career posts found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $jobs->links('pagination::bootstrap-5') }}
        </div>

      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')

<script>
  // Auto-dismiss alerts
  setTimeout(() => {
    document.querySelectorAll(".alert").forEach(el => el.remove());
  }, 4000);
</script>
