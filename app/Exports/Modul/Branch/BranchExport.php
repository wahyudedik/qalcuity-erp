<?php

namespace App\Exports\Modul\Branch;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BranchExport implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    protected $branches;
    protected $filters;

    public function __construct($branches, array $filters = [])
    {
        // Pastikan branches adalah collection
        if (!$branches instanceof Collection) {
            $branches = collect($branches);
        }
        
        $this->branches = $branches;
        $this->filters = $filters;
    }

    public function collection()
    {
        return $this->branches->map(function ($branch) {
            return [
                'name' => $branch->name,
                'code' => $branch->code,
                'city' => $branch->city ?? 'N/A',
                'province' => $branch->province ?? 'N/A',
                'address' => $branch->address ?? 'N/A',
                'postal_code' => $branch->postal_code ?? 'N/A',
                'phone' => $branch->phone ?? 'N/A',
                'email' => $branch->email ?? 'N/A',
                'manager_name' => $branch->manager_name ?? 'N/A',
                'status' => $branch->is_active ? 'Aktif' : 'Tidak Aktif',
                'users_count' => $branch->users_count ?? 0,
                'created_at' => $branch->created_at ? $branch->created_at->format('Y-m-d H:i:s') : 'N/A',
                'updated_at' => $branch->updated_at ? $branch->updated_at->format('Y-m-d H:i:s') : 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Cabang',
            'Kode',
            'Kota',
            'Provinsi',
            'Alamat',
            'Kode Pos',
            'Telepon',
            'Email',
            'Manager',
            'Status',
            'Jumlah Pengguna',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }

    public function title(): string
    {
        return 'Daftar Cabang';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],
        ];
    }
    
    /**
     * Method untuk mendapatkan data branches (untuk digunakan di PDF view)
     */
    public function getBranches()
    {
        return $this->branches;
    }
    
    /**
     * Method untuk mendapatkan filters (untuk digunakan di PDF view)
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
