@include('admin.layouts.header')

<div class="content-wrapper"> 
  <div class="col-md-10 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Maju Career Posting</h4>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('jobs.index') }}" class="btn btn-gradient-primary btn-sm">View All Career Posts</a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="title">Job Title</label>
            <input id="title" name="title" type="text" 
                   value="{{ old('title', $job->title) }}" 
                   class="form-control" required>
          </div>

          <div class="form-group">
            <label for="contact">Contact (Optional)</label>
            <input id="contact" name="contact" type="text" 
                   value="{{ old('contact', $job->contact) }}" 
                   class="form-control">
          </div>

    <div class="form-group">
    <label for="job_type">Job Type</label>
    <select id="job_type" name="job_type" class="form-control" required>
        <option value="permanent_faculty"
            {{ old('job_type', $job->job_type) == 'permanent_faculty' ? 'selected' : '' }}>
            Permanent Faculty
        </option>
        <option value="visiting_faculty"
            {{ old('job_type', $job->job_type) == 'visiting_faculty' ? 'selected' : '' }}>
            Visiting Faculty
        </option>
        <option value="staff"
            {{ old('job_type', $job->job_type) == 'staff' ? 'selected' : '' }}>
            Staff
        </option>
    </select>
</div>


          <div class="form-group">
            <label for="description">Job Description</label>
            <textarea id="description" name="description" class="form-control" rows="10" required>{{ old('description', $job->description) }}</textarea>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="Active" {{ old('status', $job->status) == 'Active' ? 'selected' : '' }}>Active</option>
              <option value="Inactive" {{ old('status', $job->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>

          <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')
