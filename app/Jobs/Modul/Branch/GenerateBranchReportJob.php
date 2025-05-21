<?php

namespace App\Jobs\Modul\Branch;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Modul\Branch\BranchService;
use Illuminate\Support\Facades\Storage;

class GenerateBranchReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filters;
    protected $userId;
    protected $reportType;

    /**
     * Create a new job instance.
     */
    public function __construct(array $filters, string $userId, string $reportType = 'pdf')
    {
        $this->filters = $filters;
        $this->userId = $userId;
        $this->reportType = $reportType;
    }

    /**
     * Execute the job.
     */
    public function handle(BranchService $branchService)
    {
        try {
            // Get user from ID
            $user = \App\Models\Modul\Auth\User::find($this->userId);

            if (!$user) {
                throw new \Exception("User tidak ditemukan");
            }

            $reportData = $branchService->generateReport($this->filters);

            // Perbaiki ekstensi file
            $fileExtension = $this->reportType === 'pdf' ? 'pdf' : 'xlsx';
            $fileName = 'branch_report_' . date('Y-m-d_H-i-s') . '.' . $fileExtension;
            
            // Pastikan direktori ada
            $directory = "modul/branch";
            Storage::disk('public')->makeDirectory($directory);
            
            $filePath = "{$directory}/{$fileName}";

            // Implementasi pembuatan PDF/Excel berdasarkan $this->reportType
            if ($this->reportType === 'pdf') {
                // Generate PDF using the dedicated Export class
                $export = new \App\Exports\Modul\Branch\BranchExport($reportData['branches'], $this->filters);
                
                // Perbaiki path template - perhatikan 'export' vs 'exports'
                $pdfContent = \Barryvdh\DomPDF\Facade\Pdf::loadView('Modul.branch.export.branches-pdf', [
                    'export' => $export,
                    'branches' => $reportData['branches'],
                    'filters' => $this->filters,
                    'statistics' => $reportData['statistics'] ?? [],
                    'generatedAt' => now()
                ])->output();

                Storage::disk('public')->put($filePath, $pdfContent);
            } else {
                // Generate Excel file
                $export = new \App\Exports\Modul\Branch\BranchExport($reportData['branches'], $this->filters);
                $excelContent = \Maatwebsite\Excel\Facades\Excel::raw($export, \Maatwebsite\Excel\Excel::XLSX);
                Storage::disk('public')->put($filePath, $excelContent);
            }

            // Gunakan URL, bukan path
            $fileUrl = url(Storage::disk('public')->url($filePath));

            // Create database notification
            $user->notifications()->create([
                'type' => 'App\Notifications\ReportGenerated',
                'data' => [
                    'message' => 'Laporan ' . strtoupper($this->reportType) . ' cabang telah siap',
                    'url' => $fileUrl,
                    'type' => $this->reportType,
                    'icon' => $this->reportType === 'pdf' ? 'pdf' : 'excel',
                    'time' => now()->toIso8601String()
                ]
            ]);

            // Broadcast event for real-time notification (opsional)
            if (class_exists('\App\Events\Modul\Branch\ReportGeneratedEvent')) {
                event(new \App\Events\Modul\Branch\ReportGeneratedEvent(
                    $this->userId,
                    $fileUrl,
                    $this->reportType
                ));
            }
            
            // Log success
            \Illuminate\Support\Facades\Log::info("Report successfully generated", [
                'type' => $this->reportType,
                'path' => $filePath,
                'url' => $fileUrl,
                'user_id' => $this->userId
            ]);
            
        } catch (\Exception $e) {
            // Log error
            \Illuminate\Support\Facades\Log::error("Error generating report", [
                'type' => $this->reportType,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Create error notification to user
            if (isset($user)) {
                $user->notifications()->create([
                    'type' => 'App\Notifications\ReportFailed',
                    'data' => [
                        'message' => 'Gagal membuat laporan ' . strtoupper($this->reportType) . ': ' . $e->getMessage(),
                        'type' => $this->reportType,
                        'icon' => 'error',
                        'time' => now()->toIso8601String()
                    ]
                ]);
            }

            // Rethrow exception to mark job as failed
            throw $e;
        }
    }
}
