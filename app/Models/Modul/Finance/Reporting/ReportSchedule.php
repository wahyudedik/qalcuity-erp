<?php

namespace App\Models\Finance\Reporting;

use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportSchedule extends Model
{
    use HasFactory;

    protected $table = 'finance_report_schedules';

    protected $fillable = [
        'report_template_id',
        'name',
        'description',
        'frequency',
        'day_of_week',
        'day_of_month',
        'month',
        'time_of_day', 
        'parameters',
        'auto_email',
        'email_recipients',
        'is_active',
        'branch_id',
    ];

    protected $casts = [
        'parameters' => 'array',
        'auto_email' => 'boolean',
        'is_active' => 'boolean',
        'time_of_day' => 'datetime:H:i',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
    ];

    // Relationships
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReportTemplate::class, 'report_template_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfFrequency($query, $frequency)
    {
        return $query->where('frequency', $frequency);
    }

    public function scopeDue($query)
    {
        return $query->where('next_run_at', '<=', now())
                     ->where('is_active', true);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Methods
    public function calculateNextRunDate()
    {
        if (!$this->last_run_at) {
            // First run - start from now
            $baseDate = Carbon::now();
        } else {
            // Use last run as base
            $baseDate = Carbon::parse($this->last_run_at);
        }

        // Extract hour and minute from time_of_day
        $timeOfDay = Carbon::parse($this->time_of_day);
        $hour = $timeOfDay->hour;
        $minute = $timeOfDay->minute;

        switch ($this->frequency) {
            case 'daily':
                $nextRun = $baseDate->addDay()->setTime($hour, $minute, 0);
                break;
                
            case 'weekly':
                $nextRun = $baseDate->addWeek();
                if ($this->day_of_week) {
                    $nextRun = $nextRun->previous(Carbon::getDays()[$this->day_of_week - 1]);
                }
                $nextRun->setTime($hour, $minute, 0);
                break;
                
            case 'monthly':
                $nextRun = $baseDate->addMonth();
                if ($this->day_of_month) {
                    // Adjust for months with fewer days
                    $daysInMonth = $nextRun->daysInMonth;
                    $day = min($this->day_of_month, $daysInMonth);
                    $nextRun->day($day);
                }
                $nextRun->setTime($hour, $minute, 0);
                break;
                
            case 'quarterly':
                $nextRun = $baseDate->addQuarter();
                if ($this->day_of_month) {
                    // Adjust for months with fewer days
                    $daysInMonth = $nextRun->daysInMonth;
                    $day = min($this->day_of_month, $daysInMonth);
                    $nextRun->day($day);
                }
                $nextRun->setTime($hour, $minute, 0);
                break;
                
            case 'yearly':
                $nextRun = $baseDate->addYear();
                if ($this->month) {
                    $nextRun->month($this->month);
                }
                if ($this->day_of_month) {
                    // Adjust for months with fewer days
                    $daysInMonth = $nextRun->daysInMonth;
                    $day = min($this->day_of_month, $daysInMonth);
                    $nextRun->day($day);
                }
                $nextRun->setTime($hour, $minute, 0);
                break;
                
            default:
                $nextRun = $baseDate->addDay()->setTime($hour, $minute, 0);
        }

        $this->next_run_at = $nextRun;
        $this->save();

        return $nextRun;
    }

    public function markAsRun()
    {
        $this->last_run_at = now();
        $this->calculateNextRunDate();
        $this->save();

        return $this;
    }

    public function getEmailRecipientsArray()
    {
        if (empty($this->email_recipients)) {
            return [];
        }
        
        // Split by comma, semicolon, or newline and trim whitespace
        return preg_split('/[,;\n]/', $this->email_recipients, -1, PREG_SPLIT_NO_EMPTY);
    }
}