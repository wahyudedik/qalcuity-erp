<?php

namespace App\Services\Modul\Branch;

use App\Models\Modul\Branch\Branch;
use App\Repositories\Modul\Branch\BranchRepository;
use Illuminate\Support\Facades\DB;

class BranchReportService
{
    protected $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /**
     * Generate comprehensive branch report
     */
    public function generateBranchReport(array $filters = [])
    {
        $query = Branch::query()->withCount('users');
        
        // Apply filters
        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }
        
        if (!empty($filters['province'])) {
            $query->where('province', $filters['province']);
        }
        
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        
        $branches = $query->latest()->get();
        
        // Get summary statistics
        $statistics = $this->getStatistics($branches);
        
        // Get geographical distribution
        $geoDistribution = $this->getGeographicalDistribution($branches);
        
        // Get user distribution
        $userDistribution = $this->getUserDistribution($branches);
        
        return [
            'branches' => $branches,
            'statistics' => $statistics,
            'geoDistribution' => $geoDistribution,
            'userDistribution' => $userDistribution,
            'filters' => $filters
        ];
    }
    
    /**
     * Get branch statistics
     */
    private function getStatistics($branches)
    {
        return [
            'total' => $branches->count(),
            'active' => $branches->where('is_active', true)->count(),
            'inactive' => $branches->where('is_active', false)->count(),
            'totalUsers' => $branches->sum('users_count'),
            'averageUsersPerBranch' => $branches->count() > 0 ? 
                round($branches->sum('users_count') / $branches->count(), 2) : 0,
        ];
    }
    
    /**
     * Get geographical distribution of branches
     */
    private function getGeographicalDistribution($branches)
    {
        $provinces = $branches->groupBy('province')->map->count();
        $cities = $branches->groupBy('city')->map->count();
        
        return [
            'provinces' => $provinces,
            'cities' => $cities
        ];
    }
    
    /**
     * Get user distribution across branches
     */
    private function getUserDistribution($branches)
    {
        $branchesWithUsers = $branches->where('users_count', '>', 0);
        $branchesWithoutUsers = $branches->where('users_count', 0);
        
        $userDistribution = $branchesWithUsers->mapWithKeys(function ($branch) {
            return [$branch->name => $branch->users_count];
        });
        
        return [
            'branchesWithUsers' => $branchesWithUsers->count(),
            'branchesWithoutUsers' => $branchesWithoutUsers->count(),
            'distribution' => $userDistribution
        ];
    }
    
    /**
     * Get cities list
     */
    public function getCities()
    {
        return Branch::distinct('city')->whereNotNull('city')->pluck('city');
    }
    
    /**
     * Get provinces list
     */
    public function getProvinces()
    {
        return Branch::distinct('province')->whereNotNull('province')->pluck('province');
    }
}