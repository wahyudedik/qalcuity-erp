<?php

namespace App\Models\Finance\Reporting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportTemplate extends Model
{
    use HasFactory;

    protected $table = 'finance_report_templates';

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'template_data',
        'is_system',
        'is_active',
    ];

    protected $casts = [
        'template_data' => 'array',
        'is_system' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'report_template_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ReportSchedule::class, 'report_template_id');
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

    public function scopeSystem($query)
    {
        return $query->where('is_system', true);
    }

    public function scopeCustom($query)
    {
        return $query->where('is_system', false);
    }

    // Methods
    public function getAvailableParameters()
    {
        // Extract and return parameters from template_data
        $templateData = $this->template_data;
        
        if (empty($templateData) || empty($templateData['parameters'])) {
            return [];
        }
        
        return $templateData['parameters'];
    }

    public function getReportStructure()
    {
        // Extract and return report structure from template_data
        $templateData = $this->template_data;
        
        if (empty($templateData) || empty($templateData['structure'])) {
            return [];
        }
        
        return $templateData['structure'];
    }

    // Template factory methods for standard reports
    public static function createBalanceSheetTemplate()
    {
        return self::create([
            'name' => 'Standard Balance Sheet',
            'code' => 'STD_BS',
            'type' => 'balance_sheet',
            'description' => 'Standard balance sheet report showing assets, liabilities and equity',
            'template_data' => [
                'parameters' => [
                    'as_of_date' => [
                        'type' => 'date',
                        'required' => true,
                        'label' => 'As of Date',
                    ],
                    'compare_previous_period' => [
                        'type' => 'boolean',
                        'required' => false,
                        'label' => 'Compare with Previous Period',
                        'default' => false,
                    ],
                ],
                'structure' => [
                    'sections' => [
                        [
                            'title' => 'Assets',
                            'account_types' => ['asset'],
                            'subtotal' => true,
                        ],
                        [
                            'title' => 'Liabilities',
                            'account_types' => ['liability'],
                            'subtotal' => true,
                        ],
                        [
                            'title' => 'Equity',
                            'account_types' => ['equity'],
                            'subtotal' => true,
                        ],
                    ],
                ],
            ],
            'is_system' => true,
            'is_active' => true,
        ]);
    }

    public static function createIncomeStatementTemplate()
    {
        return self::create([
            'name' => 'Standard Income Statement',
            'code' => 'STD_IS',
            'type' => 'income_statement',
            'description' => 'Standard income statement showing revenues, expenses and net income',
            'template_data' => [
                'parameters' => [
                    'start_date' => [
                        'type' => 'date',
                        'required' => true,
                        'label' => 'Start Date',
                    ],
                    'end_date' => [
                        'type' => 'date',
                        'required' => true,
                        'label' => 'End Date',
                    ],
                    'compare_previous_period' => [
                        'type' => 'boolean',
                        'required' => false,
                        'label' => 'Compare with Previous Period',
                        'default' => false,
                    ],
                ],
                'structure' => [
                    'sections' => [
                        [
                            'title' => 'Revenue',
                            'account_types' => ['revenue'],
                            'subtotal' => true,
                        ],
                        [
                            'title' => 'Expenses',
                            'account_types' => ['expense'],
                            'subtotal' => true,
                            'invert_sign' => true,
                        ],
                        [
                            'title' => 'Net Income',
                            'formula' => 'Revenue - Expenses',
                            'bold' => true,
                        ],
                    ],
                ],
            ],
            'is_system' => true,
            'is_active' => true,
        ]);
    }
}