<?php

namespace App\Models\Modul\Finance\Cost;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modul\Finance\Cost\Expense;
use App\Models\Modul\Finance\Cost\CostCategory;
use App\Models\Modul\Finance\Accounting\ChartOfAccount;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_expense_details';

    protected $fillable = [
        'expense_id',
        'item_name',
        'description',
        'cost_category_id',
        'account_id',
        'quantity', 
        'unit_price',
        'total_price',
        'has_receipt',
        'receipt_file',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'has_receipt' => 'boolean',
    ];

    // Relationships
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function costCategory(): BelongsTo
    {
        return $this->belongsTo(CostCategory::class, 'cost_category_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    // Methods
    public function calculateTotalPrice()
    {
        $this->total_price = $this->quantity * $this->unit_price;
        $this->save();

        // Update parent expense total
        $this->expense->updateTotalAmount();

        return $this;
    }

    protected static function booted()
    {
        static::creating(function ($detail) {
            if (empty($detail->total_price)) {
                $detail->total_price = $detail->quantity * $detail->unit_price;
            }
        });

        static::updating(function ($detail) {
            if ($detail->isDirty('quantity') || $detail->isDirty('unit_price')) {
                $detail->total_price = $detail->quantity * $detail->unit_price;
            }
        });

        static::saved(function ($detail) {
            // Update parent expense total amount
            $detail->expense->updateTotalAmount();
        });

        static::deleted(function ($detail) {
            // Update parent expense total amount
            $detail->expense->updateTotalAmount();
        });
    }
}