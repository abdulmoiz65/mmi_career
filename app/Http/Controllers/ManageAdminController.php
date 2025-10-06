<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    try {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.view_admin', compact('admins'));
    } catch (QueryException $e) {
        Log::error('DB error fetching admins: ' . $e->getMessage());
        return redirect()
            ->route('admin.dashboard')
            ->with('error', 'Unable to fetch admin list. Please try again later.');
    }
}


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Just return the create form view
        return view('admin.pages.create_admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:admins,email',
                'password' => 'required|string|min:8|confirmed',
                'role'     => 'required|in:admin,super_admin',
            ]);

            // Create admin
            Admin::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'],
            ]);

            return redirect()
                ->route('admin.pages.view_admin')
                ->with('success', 'Admin created successfully.');

        } catch (QueryException $e) {
            Log::error('DB error creating admin: ' . $e->getMessage());

            return redirect()
                ->route('admin.pages.create_admin')
                ->withInput()
                ->with('error', 'Unable to create admin. Please try again later.');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('admin.pages.edit_admin', compact('admin'));
        } catch (QueryException $e) {
            Log::error('DB error fetching admin for edit: ' . $e->getMessage());
            return redirect()
                ->route('admin.pages.view_admin')
                ->with('error', 'Unable to fetch admin details. Please try again later.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    try {
        $admin = Admin::findOrFail($id);

        if (
            $admin->role === 'super_admin' &&
            $request->role !== 'super_admin'
        ) {
            $superAdminCount = Admin::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'You cannot demote the last Super Admin.');
            }
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $admin->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()
            ->route('admin.pages.view_admin')
            ->with('success', 'Admin updated successfully!');
    } catch (QueryException $e) {
        Log::error('DB error updating admin: ' . $e->getMessage());
        return redirect()
            ->route('admin.pages.edit_admin', $id)
            ->with('error', 'Unable to update admin. Please try again later.');
    } catch (\Exception $e) {
        Log::error('Unexpected error updating admin: ' . $e->getMessage());
        return redirect()
            ->route('admin.pages.edit_admin', $id)
            ->with('error', 'Something went wrong. Please try again.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);

            // 🔒 Prevent self-deletion if you want
            if (auth('admin')->id() === $admin->id) {
                return redirect()->back()->with('error', 'You cannot delete your own account.');
            }

            $admin->delete();

            return redirect()
                ->route('admin.pages.view_admin')
                ->with('success', 'Admin deleted successfully.');
        } catch (QueryException $e) {
            Log::error("DB error deleting admin: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Unable to delete admin. Please try again later.');
        } catch (\Exception $e) {
            Log::error("General error deleting admin: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
