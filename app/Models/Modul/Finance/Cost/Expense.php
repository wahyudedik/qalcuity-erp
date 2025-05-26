<?php

namespace App\Models\Finance\Cost;

use App\Models\Branch;
use App\Models\Finance\Accounting\Journal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'finance_expenses';

    protected $fillable = [
        'reference_number',
        'expense_date',
        'title',
        'description',
        'requested_by',
        'cost_center_id',
        'total_amount',
        'status',
        'budget_allocation_id',
        'rejection_reason',
        'payment_method',
        'payment_reference',
        'journal_id',
        'branch_id',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'total_amount' => 'decimal:2',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function details(): HasMany
    {
        return $this->hasMany(ExpenseDetail::class, 'expense_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function costCenter(): BelongsTo
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id');
    }

    public function budgetAllocation(): BelongsTo
    {
        return $this->belongsTo(BudgetAllocation::class, 'budget_allocation_id');
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function paidBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by');
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

    public function scopeOfCostCenter($query, $costCenterId)
    {
        return $query->where('cost_center_id', $costCenterId);
    }

    public function scopeOfRequester($query, $userId)
    {
        return $query->where('requested_by', $userId);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Methods
    public function submit($userId)
    {
        if ($this->status !== 'draft') {
            throw new \Exception('Only draft expenses can be submitted.');
        }

        $this->status = 'submitted';
        $this->submitted_by = $userId;
        $this->submitted_at = now();
        $this->save();

        return $this;
    }

    public function approve($userId)
    {
        if ($this->status !== 'submitted') {
            throw new \Exception('Only submitted expenses can be approved.');
        }

        $this->status = 'approved';
        $this->approved_by = $userId;
        $this->approved_at = now();
        $this->save();

        // Update budget allocation if applicable
        if ($this->budget_allocation_id) {
            $this->budgetAllocation->updateUsedAmount();
        }

        return $this;
    }

    public function reject($userId, $reason)
    {
        if ($this->status !== 'submitted') {
            throw new \Exception('Only submitted expenses can be rejected.');
        }

        $this->status = 'rejected';
        $this->rejected_by = $userId;
        $this->rejected_at = now();
        $this->rejection_reason = $reason;
        $this->save();

        return $this;
    }

    public function markAsPaid($userId, $paymentMethod, $paymentReference = null)
    {
        if ($this->status !== 'approved') {
            throw new \Exception('Only approved expenses can be marked as paid.');
        }

        $this->status = 'paid';
        $this->paid_by = $userId;
        $this->paid_at = now();
        $this->payment_method = $paymentMethod;
        $this->payment_reference = $paymentReference;
        $this->save();

        return $this;
    }

    public function updateTotalAmount()
    {
        $this->total_amount = $this->details()->sum('total_price');
        $this->save();

        return $this;
    }

    // Generate unique reference number
    public static function generateReferenceNumber($prefix = 'EXP')
    {
        $latestExpense = self::orderBy('id', 'desc')->first();
        $number = $latestExpense ? $latestExpense->id + 1 : 1;

        return $prefix . '-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
} 