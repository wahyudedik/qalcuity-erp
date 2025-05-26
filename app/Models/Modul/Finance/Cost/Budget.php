<?php

namespace App\Models\Finance\Cost;

use App\Models\Branch;
use App\Models\Finance\Accounting\FinancePeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'finance_budgets';

    protected $fillable = [
        'reference_number',
        'name',
        'description',
        'start_date', 
        'end_date',
        'status',
        'finance_period_id',
        'total_amount',
        'branch_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function allocations(): HasMany
    {
        return $this->hasMany(BudgetAllocation::class, 'budget_id');
    }

    public function financePeriod(): BelongsTo
    {
        return $this->belongsTo(FinancePeriod::class, 'finance_period_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
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

    public function scopeOfPeriod($query, $periodId)
    {
        return $query->where('finance_period_id', $periodId);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    // Methods
    public function approve($userId)
    {
        if ($this->status !== 'draft') {
            throw new \Exception('Only draft budgets can be approved.');
        }

        $this->status = 'approved';
        $this->approved_by = $userId;
        $this->approved_at = now();
        $this->save();

        return $this;
    }

    public function close()
    {
        if ($this->status !== 'approved') {
            throw new \Exception('Only approved budgets can be closed.');
        }

        $this->status = 'closed';
        $this->save();

        return $this;
    }

    public function updateTotalAmount()
    {
        $this->total_amount = $this->allocations()->sum('allocated_amount');
        $this->save();

        return $this;
    }

    // Generate unique reference number
    public static function generateReferenceNumber($prefix = 'BDG')
    {
        $latestBudget = self::orderBy('id', 'desc')->first();
        $number = $latestBudget ? $latestBudget->id + 1 : 1;

        return $prefix . '-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}