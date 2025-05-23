<?php

namespace App\Models\Finance\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollStructure extends Model
{
    use HasFactory;

    protected $table = 'finance_payroll_structures';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function components(): HasMany
    {
        return $this->hasMany(PayrollStructureComponent::class, 'payroll_structure_id');
    }

    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class, 'payroll_structure_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}