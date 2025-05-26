<?php

namespace App\Models\Finance\Payroll;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Finance\Accounting\Journal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payslip extends Model
{
    use HasFactory;

    protected $table = 'finance_payslips';

    protected $fillable = [
        'reference_number',
        'employee_id',
        'payroll_period_id',
        'payroll_structure_id',
        'from_date',
        'to_date', 
        'payment_date',
        'gross_salary',
        'total_deduction',
        'net_salary',
        'tax_amount',
        'status',
        'notes',
        'payment_method',
        'bank_account',
        'journal_id',
        'branch_id',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'payment_date' => 'date',
        'gross_salary' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function details(): HasMany
    {
        return $this->hasMany(PayslipDetail::class, 'payslip_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function payrollPeriod(): BelongsTo
    {
        return $this->belongsTo(PayrollPeriod::class, 'payroll_period_id');
    }

    public function payrollStructure(): BelongsTo
    {
        return $this->belongsTo(PayrollStructure::class, 'payroll_structure_id');
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
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

    // Scopes
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeOfEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    public function scopeOfPeriod($query, $periodId)
    {
        return $query->where('payroll_period_id', $periodId);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Methods
    public function approve($userId)
    {
        if ($this->status !== 'draft') {
            throw new \Exception('Only draft payslips can be approved.');
        }

        $this->status = 'approved';
        $this->approved_by = $userId;
        $this->approved_at = now();
        $this->save();

        return $this;
    }

    public function calculateTotals()
    {
        $this->gross_salary = $this->details()
            ->whereIn('type', ['earning'])
            ->sum('amount');

        $this->total_deduction = $this->details()
            ->whereIn('type', ['deduction', 'tax'])
            ->sum('amount');

        $this->tax_amount = $this->details()
            ->where('type', 'tax')
            ->sum('amount');

        $this->net_salary = $this->gross_salary - $this->total_deduction;
        $this->save();

        return $this;
    }

    // Generate unique reference number
    public static function generateReferenceNumber($prefix = 'PAY')
    {
        $latestPayslip = self::orderBy('id', 'desc')->first();
        $number = $latestPayslip ? $latestPayslip->id + 1 : 1;

        return $prefix . '-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}