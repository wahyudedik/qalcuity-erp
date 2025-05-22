<?php

namespace App\Http\Controllers\Modul\Branch;

use Illuminate\Http\Request;
use App\Models\Modul\Auth\User;
use App\Http\Controllers\Controller;
use App\Services\Modul\Branch\BranchService;
use App\Http\Requests\Modul\Branch\BranchRequest;
use App\Jobs\Modul\Branch\GenerateBranchReportJob;
use App\Http\Requests\Modul\Branch\UserAssignmentRequest;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the branches.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'is_active']);
        $branches = $this->branchService->getBranches($filters);
        $statistics = $this->branchService->getStatistics();

        return view('modul.branch.index', compact('branches', 'statistics', 'filters'));
    }

    /**
     * Show the form for creating a new branch.
     */
    public function create()
    {
        return view('modul.branch.create');
    }

    /**
     * Store a newly created branch in storage.
     */
    public function store(BranchRequest $request)
    {
        $branch = $this->branchService->createBranch($request->validated());

        return redirect()->route('branches.index')
            ->with('success', "Branch '{$branch->name}' has been created successfully.");
    }

    /**
     * Display the specified branch.
     */
    public function show(string $id)
    {
        $branch = $this->branchService->getBranchWithUsers($id);
        return view('modul.branch.show', compact('branch'));
    }


    /**
     * Show the form for editing the specified branch.
     */
    public function edit(string $id)
    {
        $branch = $this->branchService->getBranch($id);
        return view('modul.branch.edit', compact('branch'));
    }

    /**
     * Update the specified branch in storage.
     */
    public function update(BranchRequest $request, string $id)
    {
        $branch = $this->branchService->updateBranch($id, $request->validated());

        return redirect()->route('branches.index')
            ->with('success', "Branch '{$branch->name}' has been updated successfully.");
    }

    /**
     * Remove the specified branch from storage.
     */
    public function destroy(string $id)
    {
        $branch = $this->branchService->getBranch($id);
        $name = $branch->name;

        $this->branchService->deleteBranch($id);

        return redirect()->route('branches.index')
            ->with('success', "Branch '{$name}' has been deleted successfully.");
    }

    /**
     * Show assignment form for users
     */
    public function showAssignmentForm(string $id)
    {
        $branch = $this->branchService->getBranchWithUsers($id);
        $availableUsers = $this->branchService->getAvailableUsersForBranch($id);

        return view('modul.branch.assign', compact('branch', 'availableUsers'));
    }

    /**
     * Assign users to branch
     */
    public function assignUsers(UserAssignmentRequest $request, string $id)
    {
        $this->branchService->assignUsers($id, $request->user_ids);

        return redirect()->route('branches.show', $id)
            ->with('success', 'Users have been assigned to this branch successfully.');
    }

    /**
     * Show branch reports
     */
    public function reports(Request $request)
    {
        $filters = $request->only(['city', 'province', 'is_active']);

        $cities = $this->branchService->getCities();
        $provinces = $this->branchService->getProvinces();
        $reportData = $this->branchService->generateReport($filters);

        // Paginate branches untuk ditampilkan di tabel
        $branches = $this->branchService->getBranches($filters);

        // Ekstrak statistik dari report data
        $totalBranches = $reportData['statistics']['total'];
        $activeBranches = $reportData['statistics']['active'];
        $inactiveBranches = $reportData['statistics']['inactive'];
        $totalUsers = $reportData['statistics']['totalUsers'];

        // Untuk chart, kita perlu data distribusi provinsi
        $provinceStats = [];
        foreach ($reportData['provinceDistribution'] as $province => $data) {
            $provinceStats[$province] = $data['count'];
        }

        return view('modul.branch.reports', compact(
            'branches',
            'cities',
            'provinces',
            'filters',
            'totalBranches',
            'activeBranches',
            'inactiveBranches',
            'totalUsers',
            'provinceStats'
        ));
    }

    /**
     * Export branch data to PDF
     */
    public function exportPdf(Request $request)
    {
        $filters = $request->only(['city', 'province', 'is_active']);
        \Illuminate\Support\Facades\Log::info("Dispatching PDF export job", [
            'user_id' => auth()->id(),
            'filters' => $filters
        ]);
        
        // Dispatch job to generate PDF asynchronously
        $job = new \App\Jobs\Modul\Branch\GenerateBranchReportJob($filters, auth()->id(), 'pdf');
        dispatch($job);

        return redirect()->route('branches.reports')
            ->with('info', 'Laporan PDF sedang dibuat dan akan tersedia dalam beberapa saat.');
    }

    /**
     * Export branch data to Excel
     */
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['city', 'province', 'is_active']);

        // Dispatch job to generate Excel asynchronously
        $job = new GenerateBranchReportJob($filters, Auth::id(), 'xlsx'); // Gunakan 'xlsx' bukan 'excel'
        dispatch($job);

        return redirect()->route('branches.reports')
            ->with('info', 'Laporan Excel sedang dibuat dan akan tersedia dalam beberapa saat.');
    }

    /**
     * Switch user's current branch
     */
    public function switchBranch(string $id)
    {
        $user = Auth::user();
        if ($user->switchBranch($id)) {
            return redirect()->back()->with('success', 'Cabang aktif berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke cabang tersebut.');
    }

    /**
     * Remove users from branch
     */
    public function removeUsers(Request $request, string $id)
    {
        $branch = $this->branchService->getBranch($id);

        if (!$request->has('users') || !is_array($request->users)) {
            return redirect()->back()->with('error', 'Pilih minimal satu pengguna untuk dihapus tugasnya.');
        }

        $branch->users()->detach($request->users);

        return redirect()->route('branches.show', $id)
            ->with('success', 'Pengguna berhasil dihapus dari cabang ini.');
    }
}
