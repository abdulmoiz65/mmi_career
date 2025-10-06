{{-- resources/views/user/pages/forms/permanent.blade.php --}}

<h4 class="mt-4">Permanent Faculty Details</h4>

{{-- Highest Degree --}}

<div class="form-section">
    <h6 class="mb-3">Education</h6>
<div class="mb-3">
    <label class="form-label d-block">Highest Degree <span class="text-danger">*</span></label>
    @foreach(['phd' => 'PhD', 'masters18' => 'Masters (18 Years)', 'masters16' => 'Masters (16 Years)', 'bachelors' => 'Bachelors', 'other' => 'Other'] as $value => $label)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="highest_degree" value="{{ $value }}" {{ old('highest_degree') == $value ? 'checked' : '' }} required>
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
</div>


<div class="row">
{{-- Institute --}}
<div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Name of Institute<span class="text-danger">*</span></label>
    <input type="text" name="institute" class="form-control" required value="{{ old('institute') }}">
</div>
</div>


{{-- Passing Year --}}
<div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Passing Year<span class="text-danger">*</span></label>
    <input type="number" name="passing_year" class="form-control" required min="1950" max="{{ date('Y') }}" value="{{ old('passing_year') }}">
</div>
</div>

<div class="row">
    <div class="col-md-6">
        {{-- Postal Address --}}
<div class="mb-3">
    <label class="form-label">Postal Address<span class="text-danger">*</span></label>
    <textarea name="postal_address" class="form-control" required rows="2">{{ old('postal_address') }}</textarea>
</div>

    </div>

    <div class="col-md-6">
        {{-- Current City --}}
<div class="mb-3">
    <label class="form-label">Current City<span class="text-danger">*</span></label>
    <input type="text" name="city" class="form-control" required value="{{ old('city') }}">
</div>
    </div>

</div>



{{-- Area of Specialization --}}
<div class="mb-3">
    <label class="form-label">Area of Specialization<span class="text-danger">*</span></label>
    <input type="text" name="specialization" class="form-control" required value="{{ old('specialization') }}">
</div>

</div>
</div>


<div class="form-section">
    <h6 class="mb-3">Department & Post</h6>

    <div class="row">
        {{-- Post Applied --}}
<div class="mb-3">
    <label class="form-label d-block">Post Applied For <span class="text-danger">*</span></label>
    @foreach(['professor' => 'Professor', 'associate_professor' => 'Associate Professor', 'assistant_professor' => 'Assistant Professor', 'lecturer' => 'Lecturer', 'instructor' => 'Instructor', 'lab_engineer' => 'Lab Engineer'] as $value => $label)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="post_applied[]" value="{{ $value }}" 
                   @if(is_array(old('post_applied')) && in_array($value, old('post_applied'))) checked @endif>
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
</div>

    </div>

    
        {{-- Salary Desired --}}
<div class="mb-3">
    <label class="form-label">Salary Desired<span class="text-danger">*</span></label>
    <input type="text" name="salary_desired" class="form-control" required value="{{ old('salary_desired') }}">
</div>


</div>


{{-- Employment History (Recent) --}}

<div class="form-section">
    <h6 class="mb-3">Employment History (Recent) </h6>

<div class="row">

    <div class="col-md-6">
        {{-- Organization Recent --}}
    <div class="mb-3">
    <label class="form-label">Name of Organization (Recent)<span class="text-danger">*</span></label>
    <input type="text" name="org_recent" class="form-control" value="{{ old('org_recent') }}">
    </div>
    </div>

    <div class="col-md-6">
    {{-- Designation Recent --}}
    <div class="mb-3">
        <label class="form-label">Designation (Recent)<span class="text-danger">*</span></label>
        <input type="text" name="designation_recent" class="form-control" value="{{ old('designation_recent') }}">
    </div>
    </div>

</div>
</div>


{{-- Attachments --}}

<div class="form-section">
    <h6 class="mb-3">Attachments</h6>
<div class="row g-3">
     <div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Resume (PDF/DOC, Max 5MB)<span class="text-danger">*</span></label>
    <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
</div>
</div>

 <div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Highest Degree Certificate (PDF/Image, Max 5MB)<span class="text-danger">*</span></label>
    <input type="file" name="degree_certificate" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
</div>
</div>
</div>
</div>



