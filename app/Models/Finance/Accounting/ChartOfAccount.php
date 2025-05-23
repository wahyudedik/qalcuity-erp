<?php

namespace App\Models\Finance\Accounting;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChartOfAccount extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_chart_of_accounts';

    protected $fillable = [
        'account_code',
        'name',
        'description',
        'type',
        'sub_type',
        'is_active',
        'is_cash_account',
        'is_bank_account',
        'parent_account_id',
        'opening_balance',
        'branch_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_cash_account' => 'boolean',
        'is_bank_account' => 'boolean',
        'opening_balance' => 'decimal:2',
    ];

    // Relationships
    public function parentAccount(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'parent_account_id');
    }

    public function childAccounts(): HasMany
    {
        return $this->hasMany(ChartOfAccount::class, 'parent_account_id');
    }

    public function journalDetails(): HasMany
    {
        return $this->hasMany(JournalDetail::class, 'account_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
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

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Helpers
    public function getBalanceAttribute()
    {
        // Calculate current balance from journal entries
        $debits = $this->journalDetails()->sum('debit');
        $credits = $this->journalDetails()->sum('credit');

        if (in_array($this->type, ['asset', 'expense'])) {
            return $this->opening_balance + $debits - $credits;
        }

        return $this->opening_balance + $credits - $debits;
    }
}