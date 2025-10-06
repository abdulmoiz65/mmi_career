@include('admin.layouts.header')

<div class="content-wrapper">

  {{-- Success/Error Messages --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="col-lg-8 mx-auto grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create New Admin</h4>
        <p class="card-description">Fill in the details below to add a new admin.</p>

        <form action="{{ route('admin.pages.store_admin') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
              <option value="" disabled selected>Select Role</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <button type="submit" class="btn btn-gradient-primary">Create Admin</button>
          <a href="{{ route('admin.pages.view_admin') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')
