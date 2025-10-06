<?php

// app/Http/Controllers/AdminDashboardController.php
namespace App\Http\Controllers;

use App\Models\CareerJob;
use App\Models\Application;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'jobsCount'         => CareerJob::count(),
            'applicationsCount' => Application::count(),
            'usersCount'        => User::count(),
            'shortlistedCount'  => Application::where('is_shortlisted', true)->count(),

            // NEW: get 5 most recent applications
            'recentApplications' => Application::latest()->take(5)->get(),
        ]);
    }
}

