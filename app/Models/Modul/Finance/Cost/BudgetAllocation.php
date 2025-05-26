<?php

namespace App\Models\Modul\Finance\Cost;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modul\Finance\Accounting\ChartOfAccount;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetAllocation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_budget_allocations';

    protected $fillable = [
        'budget_id',
        'cost_center_id',
        'cost_category_id',
        'account_id',
        'allocated_amount', 
        'used_amount',
        'remaining_amount',
        'notes',
    ];

    protected $casts = [
        'allocated_amount' => 'decimal:2',
        'used_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    // Relationships
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function costCenter(): BelongsTo
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id');
    }

    public function costCategory(): BelongsTo
    {
        return $this->belongsTo(CostCategory::class, 'cost_category_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'budget_allocation_id');
    }

    // Methods
    public function updateUsedAmount()
    {
        $this->used_amount = $this->expenses()
            ->whereIn('status', ['approved', 'paid'])
            ->sum('total_amount');
            
        $this->remaining_amount = $this->allocated_amount - $this->used_amount;
        $this->save();

        return $this;
    }

    protected static function booted()
    {
        static::creating(function ($allocation) {
            $allocation->used_amount = 0;
            $allocation->remaining_amount = $allocation->allocated_amount;
        });

        static::updating(function ($allocation) {
            if ($allocation->isDirty('allocated_amount')) {
                $allocation->remaining_amount = $allocation->allocated_amount - $allocation->used_amount;
            }
        });
    }
}