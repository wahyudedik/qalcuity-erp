<?php

namespace App\Models\Modul\Finance\Accounting;

use App\Models\Modul\Auth\User;
use App\Models\Modul\Branch\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Modul\Finance\Accounting\FinancePeriod;
use App\Models\Modul\Finance\Accounting\JournalDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_journals';

    protected $fillable = [
        'reference_number',
        'transaction_date',
        'description',
        'status', 
        'finance_period_id',
        'source_type',
        'source_id',
        'total_debit',
        'total_credit',
        'branch_id',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'posted_at' => 'datetime',
        'voided_at' => 'datetime',
        'total_debit' => 'decimal:2',
        'total_credit' => 'decimal:2',
    ];

    // Relationships
    public function details(): HasMany
    {
        return $this->hasMany(JournalDetail::class, 'journal_id');
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(FinancePeriod::class, 'finance_period_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function voidedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'voided_by');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Dynamic relationship for polymorphic source
    public function source()
    {
        return $this->source_type ? 
            $this->morphTo('source', 'source_type', 'source_id') : null;
    }

    // Scopes
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopePosted($query)
    {
        return $query->where('status', 'posted');
    }

    public function scopeVoided($query)
    {
        return $query->where('status', 'voided');
    }

    public function scopeOfPeriod($query, $periodId)
    {
        return $query->where('finance_period_id', $periodId);
    }

    public function scopeOfBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Methods
    public function post($userId)
    {
        if ($this->status !== 'draft') {
            throw new \Exception('Only draft journals can be posted.');
        }

        $this->status = 'posted';
        $this->posted_by = $userId;
        $this->posted_at = now();
        $this->save();

        return $this;
    }

    public function void($userId, $reason = null)
    {
        if ($this->status !== 'posted') {
            throw new \Exception('Only posted journals can be voided.');
        }

        $this->status = 'voided';
        $this->voided_by = $userId;
        $this->voided_at = now();
        if ($reason) {
            $this->description = $this->description . ' [VOIDED: ' . $reason . ']';
        }
        $this->save();

        return $this;
    }

    public function isBalanced()
    {
        return $this->total_debit == $this->total_credit;
    }

    protected static function booted()
    {
        static::saving(function ($journal) {
            // Auto calculate totals
            if ($journal->details->count() > 0) {
                $journal->total_debit = $journal->details->sum('debit');
                $journal->total_credit = $journal->details->sum('credit');
            }
        });
    }

    // Generate unique reference number
    public static function generateReferenceNumber($prefix = 'JRN')
    {
        $latestJournal = self::orderBy('id', 'desc')->first();
        $number = $latestJournal ? $latestJournal->id + 1 : 1;

        return $prefix . '-' . date('Ymd') . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}