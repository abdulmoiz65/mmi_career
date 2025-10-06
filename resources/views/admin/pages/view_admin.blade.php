@include('admin.layouts.header')

<div class="content-wrapper">

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

  <div class="col-lg-12 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Admin Management</h4>

        <div class="d-flex justify-content-end mb-3">
          <a href="" class="btn btn-gradient-primary btn-sm">Add New Admin</a>
        </div>

        <p class="card-description">
          Below is a list of all admins. Super Admins can manage other admins here.
        </p>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($admins as $admin)
              <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                  <span class="badge bg-{{ $admin->role === 'super_admin' ? 'primary' : 'secondary' }}">
                    {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                  </span>
                </td>
                <td>{{ $admin->created_at ? $admin->created_at->format('d M Y') : '—' }}</td>
                <td>
                 
                    <a href="{{ route('admin.pages.edit_admin', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                     {{-- Prevent editing/deleting Super Admin by mistake --}}
                  @if($admin->role !== 'super_admin')
                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this admin?');">
                          Delete
                        </button>
                    </form>
                  @else
                    <span class="text-muted">Protected</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No admins found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div class="mt-4">
          {{ $admins->links('pagination::bootstrap-5') }}
        </div>

      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')

<script>
  setTimeout(() => {
    document.querySelectorAll(".alert").forEach(el => el.remove());
  }, 4000);
</script>
