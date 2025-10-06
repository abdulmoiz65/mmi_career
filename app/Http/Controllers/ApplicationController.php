<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\PermanentFaculty;
use App\Models\VisitingFaculty;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\CareerJob;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ApplicationController extends Controller
{   
    public function store(Request $request)
    {
        // Step 1: Create the base application
        $application = Application::create([
            'career_job_id' => $request->career_job_id,
            'job_type' => $request->job_type,
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'linkedin_profile' => $request->linkedin_profile,
            'dob' => $request->dob,
            'salary_desired' => $request->salary_desired,
            'postal_address' => $request->postal_address,
            'city' => $request->city,
        ]);
    
        // Helper function for file uploads
        $saveFile = function ($field, $folder) use ($request) {
            if ($request->hasFile($field)) {
                return $request->file($field)->store("uploads/$folder", 'public');
            }
            return null;
        };
    
        // Step 2: Save extra details based on job type
        if ($request->job_type === 'permanent_faculty') {
            $data = $request->only([
                'highest_degree',
                'specialization',
                'institute',
                'passing_year',
                'post_applied',
                'org_recent',
                'designation_recent',
            ]);
    
            // Convert array → string
            if (isset($data['post_applied']) && is_array($data['post_applied'])) {
                $data['post_applied'] = implode(',', $data['post_applied']);
            }
    
            // Handle file uploads
            $data['resume'] = $saveFile('resume', 'resume');
            $data['degree_certificate'] = $saveFile('degree_certificate', 'degree');
    
            $application->permanentFaculty()->create($data);
        }
    
        if ($request->job_type === 'visiting_faculty') {
            $data = $request->only([
                'gender',
                'join_date',
                'highest_degree',
                'specialization',
                'institute',
                'passing_year',
                'dept',
                'post_applied',
                'org_recent',
                'designation_recent',
                'years_academia',
                'years_industry',
            ]);
    
            if (isset($data['post_applied']) && is_array($data['post_applied'])) {
                $data['post_applied'] = implode(',', $data['post_applied']);
            }
    
            $data['photo'] = $saveFile('photo', 'photos');
            $data['resume'] = $saveFile('resume', 'resume');
    
            $application->visitingFaculty()->create($data);
        }
    
        if ($request->job_type === 'staff') {
            $data = $request->only([
                'gender',
                'post_applied',
                'join_date',
                'highest_degree',
                'specialization',
                'institute',
                'passing_year',
                'org_recent',
                'designation_recent',
                'date_of_joining',
                'years_experience',
            ]);
    
            if (isset($data['post_applied']) && is_array($data['post_applied'])) {
                $data['post_applied'] = implode(',', $data['post_applied']);
            }
    
            $data['resume'] = $saveFile('resume', 'resume');
            $data['photo'] = $saveFile('photo', 'photos');
    
            $application->staff()->create($data);
        }
    
        return redirect('/')->with('success', 'Application submitted successfully!');
    }

            public function shortlist($id)
        {
            $application = \App\Models\Application::findOrFail($id);
            $application->is_shortlisted = true;
            $application->save();

            return redirect()->back()->with('success', 'Application has been shortlisted.');
        }

        // unshortlist
                public function unshortlist($id)
        {
            $application = \App\Models\Application::findOrFail($id);
            $application->is_shortlisted = false;
            $application->save();

            return redirect()->back()->with('success', 'Application removed from shortlist.');
        }


// shortlisted application 
                public function shortlisted(Request $request)
        {
            $query = Application::where('is_shortlisted', true);

            if ($request->filled('q')) {
                $q = $request->q;
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%")
                        ->orWhere('contact', 'like', "%$q%");
                });
            }

            if ($request->filled('job_type')) {
                $query->where('job_type', $request->job_type);
            }

            $applications = $query->paginate(12);

            return view('admin.pages.shortlisted', compact('applications'));
        }

        public function downloadResumes(Request $request)
        {
            $ids = $request->input('applications', []);
        
            // Prevent empty selection
            if (empty($ids)) {
                return back()->with('error', 'Please select at least one application.');
            }
        
            // Fetch only selected apps
            $applications = Application::with(['permanentFaculty', 'visitingFaculty', 'staff'])
                ->whereIn('id', $ids)
                ->get();
        
            if ($applications->isEmpty()) {
                return back()->with('error', 'No valid resumes found for the selected applications.');
            }
        
            $zip = new \ZipArchive;
            $zipFileName = storage_path('app/public/resumes.zip');
        
            if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                foreach ($applications as $app) {
                    foreach (['permanentFaculty', 'visitingFaculty', 'staff'] as $relation) {
                        if ($app->$relation && $app->$relation->resume) {
                            $resumePath = storage_path("app/public/" . $app->$relation->resume);
                            if (file_exists($resumePath)) {
                                $zip->addFile($resumePath, basename($resumePath));
                            }
                        }
                    }
                }
                $zip->close();
            }
        
            if (!file_exists($zipFileName)) {
                return back()->with('error', 'No valid resumes found.');
            }
        
            return response()->download($zipFileName)->deleteFileAfterSend(true);
        }
        
        

        // reject application
                public function reject($id)
        {
            $app = Application::findOrFail($id);
            $app->update(['is_rejected' => 1]);
            return back()->with('success', 'Application rejected successfully.');
        }

        

        public function rejected(Request $request)
{
    $query = Application::where('is_rejected', 1);

    if ($request->filled('q')) {
        $q = $request->q;
        $query->where(function($x) use ($q) {
            $x->where('name', 'like', "%$q%")
              ->orWhere('email', 'like', "%$q%")
              ->orWhere('contact', 'like', "%$q%");
        });
    }

    if ($request->filled('job_type')) {
        $query->where('job_type', $request->job_type);
    }

    $applications = $query->latest()->paginate(10);

    return view('admin.pages.rejected', compact('applications'));
}


public function unreject($id)
{
    $application = \App\Models\Application::findOrFail($id);
    $application->is_rejected = false;
    $application->save();

    return redirect()->back()->with('success', 'Application removed from shortlist.');
}

public function archived(Request $request)
{
    try {
        $query = Application::query()
            ->with(['permanentFaculty', 'visitingFaculty', 'staff'])
            ->where('is_archived', 1);

        // 🔍 Filters
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('contact', 'like', "%$q%");
            });
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // 📋 Paginate archived apps
        $applications = $query->orderBy('updated_at', 'desc')->paginate(12);

        return view('admin.pages.archived_applications', compact('applications'));

    } catch (QueryException $e) {
        Log::error('DB error fetching archived applications: ' . $e->getMessage());
        return redirect()
            ->route('admin.dashboard')
            ->with('error', 'Unable to fetch archived applications. Please try again later.');
    }
}

    
public function create($jobId)
{
    $job = \App\Models\CareerJob::findOrFail($jobId);

    return view('user.pages.apply', [
        'job_type' => $job->job_type,
        'job' => $job
    ]);
}

public function index(Request $request)
{
    $query = Application::query()->with(['permanentFaculty', 'visitingFaculty', 'staff'])->where('is_archived', 0);

    // 🔍 Filters
    if ($request->filled('q')) {
        $q = $request->q;
        $query->where(function ($sub) use ($q) {
            $sub->where('name', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('contact', 'like', "%$q%");
        });
    }

    if ($request->filled('job_type')) {
        $query->where('job_type', $request->job_type);
    }

    if ($request->filled('highest_degree')) {
        $query->whereHas('permanentFaculty', fn($q) => $q->where('highest_degree', $request->highest_degree))
              ->orWhereHas('visitingFaculty', fn($q) => $q->where('highest_degree', $request->highest_degree))
              ->orWhereHas('staff', fn($q) => $q->where('highest_degree', $request->highest_degree));
    }

    if ($request->filled('min_salary')) {
        $query->whereRaw('CAST(salary_desired AS UNSIGNED) >= ?', [$request->min_salary]);
    }

    if ($request->filled('max_salary')) {
        $query->whereRaw('CAST(salary_desired AS UNSIGNED) <= ?', [$request->max_salary]);
    }

    $applications = $query->orderBy('created_at', 'desc')->paginate(12);

    return view('admin.pages.view_applications', compact('applications'));
}

public function show($id)
{
    $application = Application::with(['permanentFaculty', 'visitingFaculty', 'staff'])->findOrFail($id);

    return view('admin.pages.view_application_show', compact('application'));
}

}
