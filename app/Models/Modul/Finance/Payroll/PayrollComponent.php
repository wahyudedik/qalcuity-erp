<?php

namespace App\Models\Finance\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollComponent extends Model
{
    use HasFactory;

    protected $table = 'finance_payroll_components';

    protected $fillable = [
        'name',
        'description',
        'type',
        'calculation_type',
        'default_value',
        'formula', 
        'is_taxable',
        'is_active',
        'sequence',
    ];

    protected $casts = [
        'default_value' => 'decimal:2',
        'is_taxable' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function structureComponents(): HasMany
    {
        return $this->hasMany(PayrollStructureComponent::class, 'payroll_component_id');
    }

    public function payslipDetails(): HasMany
    {
        return $this->hasMany(PayslipDetail::class, 'payroll_component_id');
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

    public function scopeTaxable($query)
    {
        return $query->where('is_taxable', true);
    }
}