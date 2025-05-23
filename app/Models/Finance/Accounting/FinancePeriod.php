<?php

namespace App\Models\Finance\Accounting;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinancePeriod extends Model
{
    use HasFactory;

    protected $table = 'finance_periods';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
        'notes',
        'branch_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'closed_at' => 'datetime',
    ];

    // Relationships
    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class, 'finance_period_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function closedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Helpers
    public function close($userId)
    {
        $this->status = 'closed';
        $this->closed_by = $userId;
        $this->closed_at = now();
        $this->save();

        return $this;
    }

    public function activate()
    {
        $this->status = 'active';
        $this->save();

        return $this;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isClosed()
    {
        return $this->status === 'closed';
    }
}