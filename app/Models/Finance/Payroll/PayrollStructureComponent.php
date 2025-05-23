<?php

namespace App\Models\Finance\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollStructureComponent extends Model
{
    use HasFactory;

    protected $table = 'finance_payroll_structure_components';

    protected $fillable = [
        'payroll_structure_id',
        'payroll_component_id',
        'default_value',
        'formula',
        'sequence',
    ];

    protected $casts = [
        'default_value' => 'decimal:2',
    ];

    // Relationships
    public function structure(): BelongsTo
    {
        return $this->belongsTo(PayrollStructure::class, 'payroll_structure_id');
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(PayrollComponent::class, 'payroll_component_id');
    }
}