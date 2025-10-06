@include('user.layouts.header')


<!-- Jobs Section -->
<section id="jobs" class="jobs-section">
    <div class="container">
      <div class="section-title">
        <h2>Latest Job Opportunities</h2>
        <p>Discover exciting career opportunities at Memon Medical Institute Hospital </p>
      </div>
  
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Showing {{ $jobs->count() }} jobs</h5>
      </div>
  
      <!-- Job Cards Row -->
      <div class="row g-4">
         @if($jobs->isEmpty())
        <div class="col-12">
            <h1 class="text-center text-muted">No jobs available at the moment.</h1>
        </div>
    @else
        @foreach($jobs as $index => $job)
        <div class="col-lg-4 col-md-6 job-card-wrapper {{ $index >= 6 ? 'd-none' : '' }}">
            <div class="job-card">
              <div class="job-status {{ $job->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                {{ $job->status }}
              </div>
              <div class="job-header">
                <h3 class="job-title">{{ $job->title }}</h3>
                <div class="job-university">Memon Medical Institute Hospital</div>
                <span class="job-type">{{ $job->job_type }}</span>
              </div>
              <div class="job-meta">
                <span><i class="fas fa-map-marker-alt"></i> Karachi, Pakistan</span>
                <span><i class="fas fa-users"></i> {{ $job->applications_count }} applications</span> 
                {{-- Fake for now --}}
              </div>
  
              <div class="job-actions">
                <div>
                   <button class="btn btn-apply" data-bs-toggle="modal" data-bs-target="#jobModal"
                      onclick='showJobDetails(
                          @json($job->id),
                          @json($job->title),
                          @json("Memon Medical Institute Hospital"),
                          @json($job->job_type),
                          @json(Str::limit($job->description, 2500)),
                          @json($job->applications_count),
                          @json($job->contact ?? "careers@jinnah.edu"),
                          @json($job->status),
                          @json($job->created_at->diffForHumans())
                      )'>
                      <i class="fas fa-eye me-2"></i> View Detail
                  </button>      
                </div>
                <div class="d-flex align-items-center gap-2">
                  <span class="job-date">{{ $job->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    @endif
      </div>

      @if(!$jobs->isEmpty() && $jobs->count() > 6)
      <div class="text-center mt-5">
        <button id="loadMoreBtn" 
                class=" btn btn-search "
                style="border-radius: 50px; background-color: #0066ff; border: none;">
          <i class="fas fa-plus-circle me-2"></i> Load More Jobs
        </button>
      </div>
    @endif
    


    </div>
  </section>


        <!-- Job Detail Modal -->
        <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobModalLabel">Job Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                         <div class="col-md-6">
                        <div class="job-detail-item">
                            <span class="job-detail-label">Job Title</span>
                            <div class="job-detail-value" id="modalJobTitle"></div>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                        <div class="job-detail-item">
                            <span class="job-detail-label">Job Type</span>
                            <div class="job-detail-value" id="modalJobType"></div>
                        </div>
                        </div>
                        </div>

                        <div class="job-detail-item">
                            <span class="job-detail-label">University Name</span>
                            <div class="job-detail-value" id="modalUniversityName"></div>
                        </div>
                        
                        
                        <div class="job-detail-item">
                            <span class="job-detail-label">Description</span>
                            <div class="job-detail-value job-description" id="modalDescription"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="job-detail-item">
                                    <span class="job-detail-label">Total Applications</span>
                                    <div class="job-detail-value" id="modalApplications"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="job-detail-item">
                                    <span class="job-detail-label">Upload Date</span>
                                    <div class="job-detail-value" id="modalUploadDate"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="job-detail-item">
                            <span class="job-detail-label">Contact Information</span>
                            <div class="job-detail-value" id="modalContact"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                      @if($jobs->isNotEmpty())
                          <a id="applyLink"
                            href="{{ auth()->check() ? route('applications.create', $jobs->first()->id) : route('login.form') }}"
                            class="btn btn-apply-modal">
                            <i class="fas fa-paper-plane me-2"></i> Apply Now
                          </a>
                      @endif
                  </div>
                </div>
            </div>
        </div>
@include('user.layouts.footer')