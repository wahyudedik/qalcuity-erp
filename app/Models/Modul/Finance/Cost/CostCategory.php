<?php

namespace App\Models\Modul\Finance\Cost;

use App\Models\Modul\Finance\Accounting\ChartOfAccount;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CostCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_cost_categories';

    protected $fillable = [
        'name',
        'description',
        'account_id', 
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    public function budgetAllocations(): HasMany
    {
        return $this->hasMany(BudgetAllocation::class, 'cost_category_id');
    }

    public function expenseDetails(): HasMany
    {
        return $this->hasMany(ExpenseDetail::class, 'cost_category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}