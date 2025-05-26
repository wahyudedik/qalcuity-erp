<?php

namespace App\Models\Modul\Finance\Reporting;

use App\Models\Modul\Auth\User;
use App\Models\Modul\Branch\Branch;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modul\Finance\Accounting\FinancePeriod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Modul\Finance\Reporting\ReportTemplate;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_reports';

    protected $fillable = [
        'reference_number',
        'report_template_id',
        'name',
        'start_date',
        'end_date',
        'finance_period_id', 
        'parameters',
        'report_data',
        'status',
        'file_path',
        'branch_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'parameters' => 'array',
        'report_data' => 'array',
        'generated_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReportTemplate::class, 'report_template_id');
    }

    public function financePeriod(): BelongsTo
    {
        return $this->belongsTo(FinancePeriod::class, 'finance_period_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function publishedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Scopes
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeOfTemplate($query, $templateId)
    {
        return $query->where('report_template_id', $templateId);
    }

    public function scopeOfPeriod($query, $periodId)
    {
        return $query->where('finance_period_id', $periodId);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeOfDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('start_date', [$startDate, $endDate])
              ->orWhereBetween('end_date', [$startDate, $endDate])
              ->orWhere(function ($q2) use ($startDate, $endDate) {
                  $q2->where('start_date', '<=', $startDate)
                     ->where('end_date', '>=', $endDate);
              });
        });
    }

    // Methods
    public function generate($userId)
    {
        if ($this->status !== 'draft') {
            throw new \Exception('Only draft reports can be generated.');
        }

        // This would call a service to actually generate the report data
        // based on the template and parameters
        
        // For now, we'll just mark it as generated
        $this->status = 'generated';
        $this->generated_by = $userId;
        $this->generated_at = now();
        $this->save();

        return $this;
    }

    public function publish($userId)
    {
        if ($this->status !== 'generated') {
            throw new \Exception('Only generated reports can be published.');
        }

        $this->status = 'published';
        $this->published_by = $userId;
        $this->published_at = now();
        $this->save();

        return $this;
    }

    public function archive()
    {
        if ($this->status !== 'published') {
            throw new \Exception('Only published reports can be archived.');
        }

        $this->status = 'archived';
        $this->save();

        return $this;
    }

    // Generate unique reference number
    public static function generateReferenceNumber($prefix = 'RPT')
    {
        $latestReport = self::orderBy('id', 'desc')->first();
        $number = $latestReport ? $latestReport->id + 1 : 1;

        return $prefix . '-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}