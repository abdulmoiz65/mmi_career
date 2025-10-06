
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Position - MMI Career Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-section { border: 1px solid #e8e8e8; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
        .required:after { content: " *"; color: #d33; }
        .max-600 { max-width: 900px; }
        .card {
  border-radius: 0 !important;
  position: relative !important;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px !important;
}
    </style>
</head>
<body>

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-start">

<div class="container max-600 ">

    <h2 class="mb-4 text-capitalize">Apply for {{ str_replace('_',' ', $job_type) }}</h2>

        @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="job_type" value="{{ $job_type }}">
        <input type="hidden" name="career_job_id" value="{{ $job->id }}">

        {{-- 🔹 Common Fields --}}
        <div class="form-section">
            <h6 class="mb-3">Applicant Information</h6>
        <div class="row g-3">
        <div class="col-md-6">    
        <div class="mb-3">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        </div>

        <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Contact <span class="text-danger">*</span></label>
            <input type="text" name="contact" class="form-control" required value="{{ old('contact') }}">
        </div>
        </div>
        </div>

        <div class="row g-3">
        <div class="col-md-6">    
        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        </div>

        <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="dob" class="form-control" required value="{{ old('dob') }}">
        </div>
        </div>
        </div>

         <div class="row g-3">
    <div class="col-md-12">
      <div class="mb-3">
        <label class="form-label">LinkedIn Profile (Optional)</label>
        <input 
          type="url" 
          name="linkedin_profile" 
          class="form-control" 
          placeholder="https://www.linkedin.com/in/your-profile"
          value="{{ old('linkedin_profile') }}"
        >
      </div>
    </div>
  </div>

        </div>


@if($job_type === 'permanent_faculty')
    @include('user.pages.forms.permanent')

@elseif($job_type === 'visiting_faculty')
    @include('user.pages.forms.visiting')

@elseif($job_type === 'staff')
    @include('user.pages.forms.staff')
@endif

        <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
    </form>
</div>

        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
