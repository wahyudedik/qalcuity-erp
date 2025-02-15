<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype === 'dev') {
                return view('dev.dashboard');
            }

            $sort = request()->query('sort', 'latest');
            $tenantsQuery = Tenant::query()

                ->whereHas('tenants', function ($query) {
                    $query->where('users.id', Auth::id());
                })

                ->withCount('tenants');

            $this->applySorting($tenantsQuery, $sort);

            $tenants = $tenantsQuery->paginate(10);

            $tenantStats = ['total' => Tenant::whereHas('tenants', function ($query) {
                $query->where('users.id', Auth::id());
            })->count()];

            return view('dashboard', compact('tenants', 'tenantStats', 'sort'));
        }
        return view('auth.login');
    }

    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'active':
                $query->where('status', 'active');
                break;
            case 'inactive':
                $query->where('status', 'inactive');
                break;
            default:
                $query->latest();
        }

    }}
