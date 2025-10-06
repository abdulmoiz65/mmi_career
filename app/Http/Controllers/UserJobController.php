<?php

namespace App\Http\Controllers;

use App\Models\CareerJob;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
public function index()
{
    $query = CareerJob::withCount('applications')->latest();

    // Apply filter if job_type is selected
    if (request()->filled('job_type')) {
        $query->where('job_type', request('job_type'));
    }

    $jobs = $query->get();

    return view('user.pages.index', compact('jobs'));
}

}
