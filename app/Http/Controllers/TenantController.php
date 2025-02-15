<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tenants = Tenant::all();
        // return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'domain' => 'required|string|max:255|unique:tenants',
                'database' => 'required|string|max:255|unique:tenants',
            ]);

            $domain = str_replace([' ', '_', '.'], '-', $request->domain);

            $tenant = Tenant::create([
                'name' => $request->name,
                'domain' => $domain . config('session.domain'),
                'database' => 'tenancy_' . $request->database,
            ]);

            $user = Auth::user()->id;
            $tenant->tenants()->attach($user);

            return redirect()->route('dashboard')
                ->with('success', 'Database Berhasil di Buat.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal Dalam Membuat Database Baru: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        // return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        // return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'domain' => 'required|string|max:255|unique:tenants,domain,' . $tenant->id,
                'database' => 'required|string|max:255|unique:tenants,database,' . $tenant->id,
                'status' => 'required|in:active,inactive',
            ]);

            $tenant->update($validated);

            return redirect()->route('dashboard')
                ->with('success', 'Database Berhasil di Update.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal Dalam Update Database Baru: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        try {
            // Drop the tenant's database
            DB::statement('DROP DATABASE IF EXISTS ' . $tenant->database);
            
            // Delete the tenant record
            $tenant->delete();

            return redirect()->route('dashboard')
                ->with('success', 'Database Berhasil di Hapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal Dalam Menghapus Database: ' . $e->getMessage()]);
        }
    }
}
