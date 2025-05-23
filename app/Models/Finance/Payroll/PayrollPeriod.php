<?php

namespace App\Models\Finance\Payroll;

use App\Models\Branch;
use App\Models\Finance\Accounting\FinancePeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollPeriod extends Model
{
    use HasFactory;

    protected $table = 'finance_payroll_periods';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'payment_date',
        'status',
        'finance_period_id',
        'branch_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'payment_date' => 'date',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class, 'payroll_period_id');
    }

    public function financePeriod(): BelongsTo
    {
        return $this->belongsTo(FinancePeriod::class, 'finance_period_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function paidBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by');
    }

    // Scopes
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Methods
    public function approve($userId)
    {
        if ($this->status !== 'processing') {
            throw new \Exception('Only processing payroll periods can be approved.');
        }

        $this->status = 'approved';
        $this->approved_by = $userId;
        $this->approved_at = now();
        $this->save();

        // Update all payslips to approved
        $this->payslips()->update([
            'status' => 'approved',
            'approved_by' => $userId,
            'approved_at' => now()
        ]);

        return $this;
    }

    public function markAsPaid($userId)
    {
        if ($this->status !== 'approved') {
            throw new \Exception('Only approved payroll periods can be marked as paid.');
        }

        $this->status = 'paid';
        $this->paid_by = $userId;
        $this->paid_at = now();
        $this->save();

        // Update all payslips to paid
        $this->payslips()->update([
            'status' => 'paid',
            'payment_date' => now()
        ]);

        return $this;
    }

    // Generate payslips for this period
    public function generatePayslips()
    {
        // Implementation would depend on business logic
        // but would typically involve:
        // 1. Fetch all employees
        // 2. Get their payroll structures
        // 3. Calculate salary components
        // 4. Create payslips and details
    }
}