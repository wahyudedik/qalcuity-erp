<?php

namespace App\Services\Modul\Branch;

use Exception;
use App\Models\Modul\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Events\Modul\Branch\BranchCreatedEvent;
use App\Events\Modul\Branch\BranchUpdatedEvent;
use App\Repositories\Modul\Branch\BranchRepository;

class BranchService
{
    protected $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /**
     * Get branches with optional filtering
     */
    public function getBranches(array $filters = [])
    {
        return $this->branchRepository->getAllBranches($filters);
    }

    /**
     * Get a single branch by ID
     */
    public function getBranch(string $id)
    {
        return $this->branchRepository->findById($id);
    }

    /**
     * Get a branch with its assigned users
     */
    public function getBranchWithUsers(string $id)
    {
        return $this->branchRepository->findByIdWithUsers($id);
    }

    /**
     * Create a new branch
     */
    public function createBranch(array $data)
    {
        DB::beginTransaction();
        try {
            $branch = $this->branchRepository->create($data);
            
            // Dispatch event
            event(new BranchCreatedEvent($branch));
            
            DB::commit();
            return $branch;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Update a branch
     */
    public function updateBranch(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $branch = $this->branchRepository->findById($id);
            $originalData = $branch->toArray();
            
            $this->branchRepository->update($branch, $data);
            
            // Dispatch event
            event(new BranchUpdatedEvent($branch, $originalData));
            
            DB::commit();
            return $branch;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Delete a branch
     */
    public function deleteBranch(string $id)
    {
        DB::beginTransaction();
        try {
            $branch = $this->branchRepository->findById($id);
            $this->branchRepository->delete($branch);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Assign users to a branch
     */
    public function assignUsers(string $id, array $userIds)
    {
        DB::beginTransaction();
        try {
            $branch = $this->branchRepository->findById($id);
            $this->branchRepository->assignUsers($branch, $userIds);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Get branch statistics
     */
    public function getStatistics()
    {
        return $this->branchRepository->getStatistics();
    }

    /**
     * Get unique cities
     */
    public function getCities()
    {
        return $this->branchRepository->getCities();
    }

    /**
     * Get unique provinces
     */
    public function getProvinces()
    {
        return $this->branchRepository->getProvinces();
    }
    
    /**
     * Generate report data
     */
    public function generateReport(array $filters = [])
    {
        return $this->branchRepository->generateReportData($filters);
    }

    /**
     * Get users available for assignment to a branch
     */
    public function getAvailableUsersForBranch(string $branchId)
    {
        return User::whereDoesntHave('branches', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
            ->where('usertype', '!=', 'dev') // Tambahkan kondisi ini untuk mengecualikan developer
            ->orderBy('name')
            ->get();
    }
}