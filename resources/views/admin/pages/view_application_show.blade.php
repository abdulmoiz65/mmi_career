@include('admin.layouts.header')

<style>
    .resume-wrapper{
        max-width: 900px;
        margin: 0 auto;
        background:#fff;
        padding:40px;
        box-shadow:0 0 20px rgba(0,0,0,0.1);
        font-family: "Segoe UI", Arial, sans-serif;
    }
    .resume-header{
        display:flex;
        align-items:center;
        border-bottom:2px solid #ddd;
        padding-bottom:20px;
        margin-bottom:25px;
    }
    .resume-header img{
        width:130px;
        height:130px;
        object-fit:cover;
        border-radius:50%;
        border:3px solid #ccc;
        margin-right:25px;
    }
    .resume-header h2{
        margin:0;
        font-size:1.8rem;
    }
    .resume-section{
        margin-bottom:25px;
    }
    .resume-section h4{
        font-size:1.2rem;
        margin-bottom:10px;
        border-bottom:1px solid #ddd;
        padding-bottom:5px;
        text-transform:uppercase;
        letter-spacing:1px;
    }
    .resume-section p{
        margin-bottom:5px;
    }
    .attachment-links a{
        display:inline-block;
        margin-right:15px;
        margin-bottom:8px;
    }
</style>

<div class="content-wrapper">
    <div class="resume-wrapper">

        @php
            $pf = $application->permanentFaculty;
            $vf = $application->visitingFaculty;
            $sf = $application->staff;
            $profilePhoto = $vf->photo ?? $sf->photo ?? null;
        @endphp

        {{-- ===== HEADER with optional photo ===== --}}
        <div class="resume-header">

            
            @if($profilePhoto)
                <img src="{{ asset('storage/'.$profilePhoto) }}" alt="Photo">
            @endif
            <div>
                <h2>{{ $application->name }}</h2>
                <p class="mb-1">{{ $application->email ?? '-' }}</p>
                <p class="mb-1">{{ $application->contact ?? '-' }}</p>
                <p class="mb-0 text-muted">
                    {{ ucfirst(str_replace('_',' ', $application->job_type)) }} Applicant
                </p>

{{-- ✅ Action buttons --}}
@if(!$application->is_archived)
@if($application->is_shortlisted)
    {{-- If already shortlisted: only show remove-from-shortlist --}}
    <form method="POST"
          action="{{ route('admin.applications.unshortlist', $application->id) }}"
          class="d-inline">
        @csrf
        <button class="btn btn-info btn-sm mt-2"
                onclick="return confirm('Remove from shortlist?')">
            Remove from Shortlist
        </button>
    </form>

@elseif($application->is_rejected)
    {{-- If already rejected: only show remove-from-rejected --}}
    <form method="POST"
          action="{{ route('admin.applications.unreject', $application->id) }}"
          class="d-inline">
        @csrf
        <button class="btn btn-warning btn-sm mt-2"
                onclick="return confirm('Remove from rejected?')">
            Remove from Rejected
        </button>
    </form>

@else
    {{-- If neither: show both options --}}
    <form method="POST"
          action="{{ route('admin.applications.shortlist', $application->id) }}"
          class="d-inline">
        @csrf
        <button class="btn btn-success btn-sm mt-2"
                onclick="return confirm('Shortlist this application?')">
            Add to Shortlist
        </button>
    </form>

    <form method="POST"
          action="{{ route('admin.applications.reject', $application->id) }}"
          class="d-inline">
        @csrf
        <button class="btn btn-danger btn-sm mt-2"
                onclick="return confirm('Reject this application?')">
            Reject Application
        </button>
    </form>
@endif
@endif



            </div>
        </div>

        {{-- ===== Personal Info ===== --}}
<div class="resume-section">
    <h4>Personal Information</h4>
    <p><strong>Date of Birth:</strong> {{ $application->dob ?? '-' }}</p>
    <p><strong>City:</strong> {{ $application->city ?? '-' }}</p>
    <p><strong>Postal Address:</strong> {{ $application->postal_address ?? '-' }}</p>
    <p><strong>Desired Salary:</strong> {{ $application->salary_desired ?? '-' }}</p>

    {{-- ✅ New LinkedIn Profile --}}
    @if(!empty($application->linkedin_profile))
        <p>
            <strong>LinkedIn:</strong>
            <a href="{{ $application->linkedin_profile }}" 
               target="_blank" 
               style="color:#0a66c2; text-decoration:none;">
               {{ $application->linkedin_profile }}
            </a>
        </p>
    @endif

    <p><strong>Submitted At:</strong> {{ $application->created_at->format('d M, Y h:i A') }}</p>
</div>

        {{-- ===== Education & Experience based on job type ===== --}}
        @if($pf)
            <div class="resume-section">
                <h4>Education</h4>
                <p><strong>Highest Degree:</strong> {{ $pf->highest_degree }}</p>
                <p><strong>Specialization:</strong> {{ $pf->specialization }}</p>
                <p><strong>Institute:</strong> {{ $pf->institute }}</p>
                <p><strong>Passing Year:</strong> {{ $pf->passing_year }}</p>
            </div>
            <div class="resume-section">
                <h4>Experience</h4>
                <p><strong>Post Applied:</strong> {{ $pf->post_applied }}</p>
                <p><strong>Recent Organization:</strong> {{ $pf->org_recent }}</p>
                <p><strong>Recent Designation:</strong> {{ $pf->designation_recent }}</p>
            </div>
        @elseif($vf)
            <div class="resume-section">
                <h4>Education</h4>
                <p><strong>Highest Degree:</strong> {{ $vf->highest_degree }}</p>
                <p><strong>Specialization:</strong> {{ $vf->specialization }}</p>
                <p><strong>Institute:</strong> {{ $vf->institute }}</p>
                <p><strong>Passing Year:</strong> {{ $vf->passing_year }}</p>
                <p><strong>Department:</strong> {{ $vf->dept }}</p>
            </div>
            <div class="resume-section">
                <h4>Experience</h4>
                <p><strong>Post Applied:</strong> {{ $vf->post_applied }}</p>
                <p><strong>Recent Organization:</strong> {{ $vf->org_recent }}</p>
                <p><strong>Recent Designation:</strong> {{ $vf->designation_recent }}</p>
                <p><strong>Years in Academia:</strong> {{ $vf->years_academia }}</p>
                <p><strong>Years in Industry:</strong> {{ $vf->years_industry }}</p>
            </div>
        @elseif($sf)
            <div class="resume-section">
                <h4>Education</h4>
                <p><strong>Highest Degree:</strong> {{ $sf->highest_degree }}</p>
                <p><strong>Specialization:</strong> {{ $sf->specialization }}</p>
                <p><strong>Institute:</strong> {{ $sf->institute }}</p>
                <p><strong>Passing Year:</strong> {{ $sf->passing_year }}</p>
            </div>
            <div class="resume-section">
                <h4>Experience</h4>
                <p><strong>Post Applied:</strong> {{ $sf->post_applied }}</p>
                <p><strong>Recent Organization:</strong> {{ $sf->org_recent }}</p>
                <p><strong>Recent Designation:</strong> {{ $sf->designation_recent }}</p>
                <p><strong>Date of Joining:</strong> {{ $sf->date_of_joining }}</p>
                <p><strong>Years Experience:</strong> {{ $sf->years_experience }}</p>
            </div>
        @endif

        {{-- ===== Attachments ===== --}}
        <div class="resume-section">
            <h4>Attachments</h4>
            <div class="attachment-links">
                @if($pf?->resume || $vf?->resume || $sf?->resume)
                    <a href="{{ asset('storage/'.($pf->resume ?? $vf->resume ?? $sf->resume)) }}"
                       target="_blank" class="btn btn-sm btn-primary">
                        View Resume
                    </a>
                @endif

                @if($pf?->degree_certificate)
                    <a href="{{ asset('storage/'.$pf->degree_certificate) }}"
                       target="_blank" class="btn btn-sm btn-primary">
                        View Degree Certificate
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.pages.view_applications') }}" class="btn btn-secondary">
                ← Back to Applications
            </a>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
