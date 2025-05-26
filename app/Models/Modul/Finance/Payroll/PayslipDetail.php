<?php

namespace App\Models\Modul\Finance\Payroll;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayslipDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'finance_payslip_details';

    protected $fillable = [
        'payslip_id',
        'payroll_component_id',
        'component_name',
        'type',
        'amount', 
        'calculation_note',
        'sequence',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function payslip(): BelongsTo
    {
        return $this->belongsTo(Payslip::class);
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(PayrollComponent::class, 'payroll_component_id');
    }
}