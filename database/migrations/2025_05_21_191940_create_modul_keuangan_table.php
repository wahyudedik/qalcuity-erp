<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ======== AKUNTANSI & PEMBUKUAN ========
        
        // Tabel Chart of Accounts (Bagan Akun)
        Schema::create('finance_chart_of_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('account_code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['asset', 'liability', 'equity', 'revenue', 'expense']);
            $table->string('sub_type')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_cash_account')->default(false);
            $table->boolean('is_bank_account')->default(false);
            $table->foreignId('parent_account_id')->nullable()->constrained('finance_chart_of_accounts')->onDelete('set null');
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Period Keuangan
        Schema::create('finance_periods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'active', 'closed'])->default('draft');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('closed_by')->nullable()->constrained('users');
            $table->timestamp('closed_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Jurnal
        Schema::create('finance_journals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'posted', 'voided'])->default('draft');
            $table->foreignId('finance_period_id')->constrained('finance_periods');
            $table->string('source_type')->nullable(); // 'invoice', 'payment', 'manual', etc
            $table->unsignedBigInteger('source_id')->nullable(); // ID of the source document
            $table->decimal('total_debit', 15, 2)->default(0);
            $table->decimal('total_credit', 15, 2)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('posted_by')->nullable()->constrained('users');
            $table->timestamp('posted_at')->nullable();
            $table->foreignId('voided_by')->nullable()->constrained('users');
            $table->timestamp('voided_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Jurnal Detail (Entri Jurnal)
        Schema::create('finance_journal_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('journal_id')->constrained('finance_journals')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('finance_chart_of_accounts');
            $table->text('description')->nullable();
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->timestamps();
        });

        // ======== PENGGAJIAN ========
        
        // Tabel Struktur Penggajian
        Schema::create('finance_payroll_structures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel Komponen Penggajian
        Schema::create('finance_payroll_components', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['earning', 'deduction', 'tax', 'other']);
            $table->enum('calculation_type', ['fixed', 'percentage', 'formula', 'table']);
            $table->decimal('default_value', 15, 2)->nullable();
            $table->string('formula')->nullable();
            $table->boolean('is_taxable')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tabel Hubungan Struktur dan Komponen Penggajian
        Schema::create('finance_payroll_structure_components', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('payroll_structure_id')->constrained('finance_payroll_structures')->onDelete('cascade');
            $table->foreignId('payroll_component_id')->constrained('finance_payroll_components')->onDelete('cascade');
            $table->decimal('default_value', 15, 2)->nullable();
            $table->string('formula')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tabel Periode Penggajian
        Schema::create('finance_payroll_periods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('payment_date')->nullable();
            $table->enum('status', ['draft', 'processing', 'approved', 'paid', 'closed'])->default('draft');
            $table->foreignId('finance_period_id')->constrained('finance_periods');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users');
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Slip Gaji
        Schema::create('finance_payslips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('payroll_period_id')->constrained('finance_payroll_periods');
            $table->foreignId('payroll_structure_id')->constrained('finance_payroll_structures');
            $table->date('from_date');
            $table->date('to_date');
            $table->date('payment_date')->nullable();
            $table->decimal('gross_salary', 15, 2)->default(0);
            $table->decimal('total_deduction', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->enum('status', ['draft', 'approved', 'paid'])->default('draft');
            $table->text('notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('bank_account')->nullable();
            $table->foreignId('journal_id')->nullable()->constrained('finance_journals');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Detail Slip Gaji
        Schema::create('finance_payslip_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('payslip_id')->constrained('finance_payslips')->onDelete('cascade');
            $table->foreignId('payroll_component_id')->constrained('finance_payroll_components');
            $table->string('component_name');
            $table->enum('type', ['earning', 'deduction', 'tax', 'other']);
            $table->decimal('amount', 15, 2);
            $table->text('calculation_note')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // ======== MANAJEMEN BIAYA ========
        
        // Tabel Pusat Biaya
        Schema::create('finance_cost_centers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('parent_id')->nullable()->constrained('finance_cost_centers')->onDelete('set null');
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Kategori Biaya
        Schema::create('finance_cost_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('finance_chart_of_accounts');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel Anggaran
        Schema::create('finance_budgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'approved', 'closed'])->default('draft');
            $table->foreignId('finance_period_id')->constrained('finance_periods');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Alokasi Anggaran
        Schema::create('finance_budget_allocations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('budget_id')->constrained('finance_budgets')->onDelete('cascade');
            $table->foreignId('cost_center_id')->nullable()->constrained('finance_cost_centers');
            $table->foreignId('cost_category_id')->nullable()->constrained('finance_cost_categories');
            $table->foreignId('account_id')->constrained('finance_chart_of_accounts');
            $table->decimal('allocated_amount', 15, 2);
            $table->decimal('used_amount', 15, 2)->default(0);
            $table->decimal('remaining_amount', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Tabel Pencatatan Biaya
        Schema::create('finance_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->date('expense_date');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('requested_by')->constrained('users');
            $table->foreignId('cost_center_id')->nullable()->constrained('finance_cost_centers');
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected', 'paid'])->default('draft');
            $table->foreignId('budget_allocation_id')->nullable()->constrained('finance_budget_allocations');
            $table->text('rejection_reason')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->foreignId('journal_id')->nullable()->constrained('finance_journals');
            $table->foreignId('submitted_by')->nullable()->constrained('users');
            $table->timestamp('submitted_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('rejected_by')->nullable()->constrained('users');
            $table->timestamp('rejected_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users');
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Detail Biaya
        Schema::create('finance_expense_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('expense_id')->constrained('finance_expenses')->onDelete('cascade');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->foreignId('cost_category_id')->nullable()->constrained('finance_cost_categories');
            $table->foreignId('account_id')->nullable()->constrained('finance_chart_of_accounts');
            $table->decimal('quantity', 10, 2)->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->boolean('has_receipt')->default(false);
            $table->string('receipt_file')->nullable();
            $table->timestamps();
        });

        // ======== PELAPORAN KEUANGAN ========
        
        // Tabel Template Laporan
        Schema::create('finance_report_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['balance_sheet', 'income_statement', 'cash_flow', 'trial_balance', 'budget_report', 'expense_report', 'custom']);
            $table->text('description')->nullable();
            $table->longText('template_data')->nullable(); // Stored as JSON or serialized array
            $table->boolean('is_system')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel Laporan Keuangan
        Schema::create('finance_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->foreignId('report_template_id')->constrained('finance_report_templates');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('finance_period_id')->nullable()->constrained('finance_periods');
            $table->longText('parameters')->nullable(); // Stored as JSON
            $table->longText('report_data')->nullable(); // Stored as JSON
            $table->enum('status', ['draft', 'generated', 'published', 'archived'])->default('draft');
            $table->string('file_path')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('generated_by')->nullable()->constrained('users');
            $table->timestamp('generated_at')->nullable();
            $table->foreignId('published_by')->nullable()->constrained('users');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });

        // Tabel Jadwal Laporan
        Schema::create('finance_report_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('report_template_id')->constrained('finance_report_templates');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly']);
            $table->unsignedTinyInteger('day_of_week')->nullable(); // 1-7 for weekly
            $table->unsignedTinyInteger('day_of_month')->nullable(); // 1-31 for monthly
            $table->unsignedTinyInteger('month')->nullable(); // 1-12 for yearly
            $table->time('time_of_day')->nullable();
            $table->longText('parameters')->nullable(); // Stored as JSON
            $table->boolean('auto_email')->default(false);
            $table->text('email_recipients')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel dalam urutan terbalik untuk menghindari constraint error
        Schema::dropIfExists('finance_report_schedules');
        Schema::dropIfExists('finance_reports');
        Schema::dropIfExists('finance_report_templates');
        
        Schema::dropIfExists('finance_expense_details');
        Schema::dropIfExists('finance_expenses');
        Schema::dropIfExists('finance_budget_allocations');
        Schema::dropIfExists('finance_budgets');
        Schema::dropIfExists('finance_cost_categories');
        Schema::dropIfExists('finance_cost_centers');
        
        Schema::dropIfExists('finance_payslip_details');
        Schema::dropIfExists('finance_payslips');
        Schema::dropIfExists('finance_payroll_periods');
        Schema::dropIfExists('finance_payroll_structure_components');
        Schema::dropIfExists('finance_payroll_components');
        Schema::dropIfExists('finance_payroll_structures');
        
        Schema::dropIfExists('finance_journal_details');
        Schema::dropIfExists('finance_journals');
        Schema::dropIfExists('finance_periods');
        Schema::dropIfExists('finance_chart_of_accounts');
    }
};
