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

  <div class="col-lg-8 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Admin</h4>

        <form method="POST" action="{{ route('admin.pages.update_admin', $admin->id) }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $admin->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $admin->email) }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Password (leave blank to keep same)</label>
            <input type="password" name="password" class="form-control">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
              <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="super_admin" {{ $admin->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <button type="submit" class="btn btn-gradient-primary">Update</button>
          <a href="{{ route('admin.pages.view_admin') }}" class="btn btn-secondary">Cancel</a>
        </form>
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
