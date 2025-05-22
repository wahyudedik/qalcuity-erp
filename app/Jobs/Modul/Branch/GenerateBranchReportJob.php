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
                \Illuminate\Support\Facades\Log::error("User tidak ditemukan", ['user_id' => $this->userId]);
                throw new \Exception("User tidak ditemukan");
            }

            \Illuminate\Support\Facades\Log::info("Starting report generation", [
                'user_id' => $this->userId,
                'type' => $this->reportType,
                'filters' => $this->filters
            ]);

            $reportData = $branchService->generateReport($this->filters);
            
            \Illuminate\Support\Facades\Log::info("Report data generated", [
                'branches_count' => count($reportData['branches'] ?? []),
            ]);

            // Pastikan direktori ada
            $directory = "modul/branch";
            Storage::disk('public')->makeDirectory($directory);
            
            $fileExtension = $this->reportType === 'pdf' ? 'pdf' : 'xlsx';
            $fileName = 'branch_report_' . date('Y-m-d_H-i-s') . '.' . $fileExtension;
            $filePath = "{$directory}/{$fileName}";
            
            \Illuminate\Support\Facades\Log::info("File path prepared", ['path' => $filePath]);
            
            // Implementasi pembuatan PDF/Excel berdasarkan $this->reportType
            if ($this->reportType === 'pdf') {
                \Illuminate\Support\Facades\Log::info("Generating PDF");
                // Gunakan namespace lengkap untuk menghindari error
                $export = new \App\Exports\Modul\Branch\BranchExport($reportData['branches'], $this->filters);
                
                // Coba panggil view terlebih dahulu
                $view = view('Modul.branch.export.branches-pdf', [
                    'export' => $export,
                    'branches' => $reportData['branches'],
                    'filters' => $this->filters,
                    'statistics' => $reportData['statistics'] ?? [],
                    'generatedAt' => now()
                ])->render();
                
                \Illuminate\Support\Facades\Log::info("View rendered successfully");
                
                // Kemudian render PDF
                $pdfContent = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($view)->output();
                \Illuminate\Support\Facades\Log::info("PDF content generated");
                
                Storage::disk('public')->put($filePath, $pdfContent);
                \Illuminate\Support\Facades\Log::info("PDF file saved");
            } else {
                \Illuminate\Support\Facades\Log::info("Generating Excel");
                $export = new \App\Exports\Modul\Branch\BranchExport($reportData['branches'], $this->filters);
                $excelContent = \Maatwebsite\Excel\Facades\Excel::raw($export, \Maatwebsite\Excel\Excel::XLSX);
                \Illuminate\Support\Facades\Log::info("Excel content generated");
                
                Storage::disk('public')->put($filePath, $excelContent);
                \Illuminate\Support\Facades\Log::info("Excel file saved");
            }

            // Gunakan URL yang dapat diakses
            $fileUrl = url('storage/' . $filePath);
            \Illuminate\Support\Facades\Log::info("File URL generated", ['url' => $fileUrl]);
            
            // Buat notifikasi dengan lebih detail
            \Illuminate\Support\Facades\Log::info("Creating notification");

            // Gunakan DatabaseNotification class langsung
            $notificationId = \Illuminate\Support\Str::uuid()->toString();
            
            \Illuminate\Support\Facades\DB::table('notifications')->insert([
                'id' => $notificationId,
                'type' => 'App\Notifications\ReportGenerated',
                'notifiable_type' => get_class($user),
                'notifiable_id' => $user->id,
                'data' => json_encode([
                    'message' => 'Laporan ' . strtoupper($this->reportType) . ' cabang telah siap',
                    'url' => $fileUrl,
                    'type' => $this->reportType,
                    'icon' => $this->reportType === 'pdf' ? 'pdf' : 'excel',
                    'time' => now()->toIso8601String()
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            \Illuminate\Support\Facades\Log::info("Notification created successfully", ['id' => $notificationId]);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Error in GenerateBranchReportJob", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }
}
