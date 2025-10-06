@include('admin.layouts.header')

<div class="content-wrapper"> 
  <div class="col-md-12 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add Maju Career Posting</h4>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('jobs.index')}}" class="btn btn-gradient-primary btn-sm">View All Career Posts</a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST" class="forms-sample">
          @csrf

          {{-- Job Title --}}
          <div class="form-group">
            <label for="title">Job Title</label>
            <input 
              id="title" 
              name="title" 
              type="text" 
              class="form-control @error('title') is-invalid @enderror" 
              placeholder="Enter Job Title" 
              maxlength="200" 
              value="{{ old('title') }}" 
              required>
            @error('title')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Contact --}}
          <div class="form-group">
            <label for="contact">Contact (Optional)</label>
            <input 
              id="contact" 
              name="contact" 
              type="text" 
              class="form-control @error('contact') is-invalid @enderror" 
              placeholder="Email or phone" 
              maxlength="255" 
              value="{{ old('contact') }}">
            @error('contact')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Job Type --}}
          <div class="form-group">
    <label for="job_type">Job Type</label>
    <select 
        id="job_type"
        name="job_type"
        class="form-control @error('job_type') is-invalid @enderror"
        required
    >
        <option value="">Select type</option>
        <option value="permanent_faculty" {{ old('job_type') == 'permanent_faculty' ? 'selected' : '' }}>
            Permanent Faculty
        </option>
        <option value="visiting_faculty" {{ old('job_type') == 'visiting_faculty' ? 'selected' : '' }}>
            Visiting Faculty
        </option>
        <option value="staff" {{ old('job_type') == 'staff' ? 'selected' : '' }}>
            Staff
        </option>
    </select>
    @error('job_type')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


          {{-- Job Description --}}
          <div class="form-group">
            <label for="description">Job Description</label>
            <textarea 
              id="description" 
              name="description" 
              class="form-control @error('description') is-invalid @enderror" 
              rows="10" 
              placeholder="Describe the job..." 
              required>{{ old('description') }}</textarea>
            @error('description')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          {{-- Status --}}
          <div class="form-group">
            <label for="status">Status</label>
            <select 
              id="status" 
              name="status" 
              class="form-control @error('status') is-invalid @enderror" 
              required>
              <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
              <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('admin.layouts.footer')
