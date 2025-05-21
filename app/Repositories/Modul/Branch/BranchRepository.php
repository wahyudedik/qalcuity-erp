<?php

namespace App\Repositories\Modul\Branch;

use App\Models\Modul\Branch\Branch;
use App\Models\Modul\Auth\User;
use Illuminate\Support\Facades\DB;

class BranchRepository
{
    protected $model;

    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }

    /**
     * Get all branches with optional filtering
     */
    public function getAllBranches(array $filters = [])
    {
        $query = $this->model->query();

        // Apply search filter
        if (isset($filters['search']) && !empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $search = '%' . $filters['search'] . '%';
                $q->where('name', 'like', $search)
                  ->orWhere('code', 'like', $search)
                  ->orWhere('city', 'like', $search)
                  ->orWhere('province', 'like', $search);
            });
        }

        // Apply active status filter
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Find branch by ID
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find branch by ID with users
     */
    public function findByIdWithUsers($id)
    {
        return $this->model->with('users')->findOrFail($id);
    }

    /**
     * Create a new branch
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a branch
     */
    public function update(Branch $branch, array $data)
    {
        $branch->update($data);
        return $branch;
    }

    /**
     * Delete a branch
     */
    public function delete(Branch $branch)
    {
        return $branch->delete();
    }

    /**
     * Assign users to a branch
     */
    public function assignUsers(Branch $branch, array $userIds)
    {
        return $branch->users()->sync($userIds);
    }
    
    /**
     * Get branch statistics
     */
    public function getStatistics()
    {
        $total = $this->model->count();
        $active = $this->model->where('is_active', true)->count();
        
        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $total - $active,
            'cities' => $this->model->distinct('city')->whereNotNull('city')->count(),
            'provinces' => $this->model->distinct('province')->whereNotNull('province')->count()
        ];
    }
    
    /**
     * Get unique cities
     */
    public function getCities()
    {
        return $this->model->distinct('city')->whereNotNull('city')->pluck('city');
    }
    
    /**
     * Get unique provinces
     */
    public function getProvinces()
    {
        return $this->model->distinct('province')->whereNotNull('province')->pluck('province');
    }
    
    /**
     * Generate branch report data
     */
    public function generateReportData(array $filters = [])
    {
        $query = $this->model->withCount('users');
        
        // Apply city filter
        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }
        
        // Apply province filter
        if (!empty($filters['province'])) {
            $query->where('province', $filters['province']);
        }
        
        // Apply active status filter
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }
        
        $branches = $query->get();
        
        // Prepare statistics
        $statistics = [
            'total' => $branches->count(),
            'active' => $branches->where('is_active', true)->count(),
            'inactive' => $branches->where('is_active', false)->count(),
            'totalUsers' => $branches->sum('users_count'),
            'averageUsersPerBranch' => $branches->count() > 0 ? 
                round($branches->sum('users_count') / $branches->count(), 2) : 0
        ];
        
        // Prepare geographical distribution
        $cityDistribution = $branches->groupBy('city')->map(function ($items) {
            return [
                'count' => $items->count(),
                'users' => $items->sum('users_count')
            ];
        });
        
        $provinceDistribution = $branches->groupBy('province')->map(function ($items) {
            return [
                'count' => $items->count(),
                'users' => $items->sum('users_count')
            ];
        });
        
        return [
            'branches' => $branches,
            'statistics' => $statistics,
            'cityDistribution' => $cityDistribution,
            'provinceDistribution' => $provinceDistribution
        ];
    }
}