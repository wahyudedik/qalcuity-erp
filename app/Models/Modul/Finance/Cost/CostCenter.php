<?php

namespace App\Models\Modul\Finance\Cost;

use App\Models\Modul\Branch\Branch;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modul\Finance\Cost\BudgetAllocation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostCenter extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_cost_centers';

    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active', 
        'parent_id',
        'branch_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(CostCenter::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(CostCenter::class, 'parent_id');
    }

    public function budgetAllocations(): HasMany
    {
        return $this->hasMany(BudgetAllocation::class, 'cost_center_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'cost_center_id');
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

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Helpers
    public function getAllChildren()
    {
        $allChildren = collect([$this]);

        $this->children->each(function ($child) use (&$allChildren) {
            $allChildren = $allChildren->merge($child->getAllChildren());
        });

        return $allChildren;
    }
}