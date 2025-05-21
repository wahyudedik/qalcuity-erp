<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Modul\Auth\User;
use Illuminate\Database\Seeder;
use App\Models\Modul\Branch\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define some realistic branch data
        $branches = [
            [
                'name' => 'Jakarta Pusat Branch',
                'code' => 'JKT01',
                'address' => 'Jl. Sudirman No. 123',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'postal_code' => '10220',
                'phone' => '021-5551234',
                'email' => 'jakarta.pusat@betonquality.com',
                'manager_name' => 'Ahmad Suparjo',
                'is_active' => true,
                'latitude' => '-6.1753871',
                'longitude' => '106.8249641',
            ],
            [
                'name' => 'Jakarta Selatan Branch',
                'code' => 'JKT02',
                'address' => 'Jl. TB Simatupang No. 45',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12560',
                'phone' => '021-7891234',
                'email' => 'jakarta.selatan@betonquality.com',
                'manager_name' => 'Dewi Suryani',
                'is_active' => true,
                'latitude' => '-6.2614927',
                'longitude' => '106.8105998',
            ],
            [
                'name' => 'Bekasi Branch',
                'code' => 'BKS01',
                'address' => 'Jl. Ahmad Yani No. 78',
                'city' => 'Bekasi',
                'province' => 'Jawa Barat',
                'postal_code' => '17141',
                'phone' => '021-8872345',
                'email' => 'bekasi@betonquality.com',
                'manager_name' => 'Budi Santoso',
                'is_active' => true,
                'latitude' => '-6.2382699',
                'longitude' => '106.9755726',
            ],
            [
                'name' => 'Bandung Branch',
                'code' => 'BDG01',
                'address' => 'Jl. Asia Afrika No. 56',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40112',
                'phone' => '022-4231234',
                'email' => 'bandung@betonquality.com',
                'manager_name' => 'Rina Wijaya',
                'is_active' => true,
                'latitude' => '-6.9211719',
                'longitude' => '107.6047993',
            ],
            [
                'name' => 'Surabaya Branch',
                'code' => 'SBY01',
                'address' => 'Jl. Darmo No. 89',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60265',
                'phone' => '031-5678901',
                'email' => 'surabaya@betonquality.com',
                'manager_name' => 'Hendra Gunawan',
                'is_active' => true,
                'latitude' => '-7.2756141',
                'longitude' => '112.7535059',
            ],
            [
                'name' => 'Semarang Branch',
                'code' => 'SMG01',
                'address' => 'Jl. Pemuda No. 102',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'postal_code' => '50139',
                'phone' => '024-8412345',
                'email' => 'semarang@betonquality.com',
                'manager_name' => 'Siti Rahayu',
                'is_active' => true,
                'latitude' => '-6.9916683',
                'longitude' => '110.4231515',
            ],
            [
                'name' => 'Medan Branch',
                'code' => 'MDN01',
                'address' => 'Jl. Diponegoro No. 34',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'postal_code' => '20152',
                'phone' => '061-4567890',
                'email' => 'medan@betonquality.com',
                'manager_name' => 'Rudi Hartono',
                'is_active' => true,
                'latitude' => '3.5896654',
                'longitude' => '98.6738261',
            ],
            [
                'name' => 'Makassar Branch',
                'code' => 'MKS01',
                'address' => 'Jl. Urip Sumoharjo No. 67',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90231',
                'phone' => '0411-234567',
                'email' => 'makassar@betonquality.com',
                'manager_name' => 'Andi Firman',
                'is_active' => true,
                'latitude' => '-5.1342962',
                'longitude' => '119.4124282',
            ],
            [
                'name' => 'Denpasar Branch',
                'code' => 'DPS01',
                'address' => 'Jl. Bypass Ngurah Rai No. 123',
                'city' => 'Denpasar',
                'province' => 'Bali',
                'postal_code' => '80361',
                'phone' => '0361-789012',
                'email' => 'denpasar@betonquality.com',
                'manager_name' => 'Made Sudarsana',
                'is_active' => true,
                'latitude' => '-8.6478175',
                'longitude' => '115.2191196',
            ],
            [
                'name' => 'Yogyakarta Branch',
                'code' => 'YGY01',
                'address' => 'Jl. Malioboro No. 45',
                'city' => 'Yogyakarta',
                'province' => 'Daerah Istimewa Yogyakarta',
                'postal_code' => '55271',
                'phone' => '0274-567890',
                'email' => 'yogyakarta@betonquality.com',
                'manager_name' => 'Sri Handayani',
                'is_active' => false, // Inactive branch for testing
                'latitude' => '-7.7956254',
                'longitude' => '110.3694896',
            ],
            [
                'name' => 'Palembang Branch',
                'code' => 'PLB01',
                'address' => 'Jl. Jendral Sudirman No. 56',
                'city' => 'Palembang',
                'province' => 'Sumatera Selatan',
                'postal_code' => '30129',
                'phone' => '0711-345678',
                'email' => 'palembang@betonquality.com',
                'manager_name' => 'Agus Setiawan',
                'is_active' => true,
                'latitude' => '-2.9760735',
                'longitude' => '104.7754307',
            ],
            [
                'name' => 'Balikpapan Branch',
                'code' => 'BPP01',
                'address' => 'Jl. MT Haryono No. 78',
                'city' => 'Balikpapan',
                'province' => 'Kalimantan Timur',
                'postal_code' => '76114',
                'phone' => '0542-876543',
                'email' => 'balikpapan@betonquality.com',
                'manager_name' => 'Hadi Wijaya',
                'is_active' => true,
                'latitude' => '-1.2635389',
                'longitude' => '116.8278843',
            ],
            [
                'name' => 'Manado Branch',
                'code' => 'MND01',
                'address' => 'Jl. Sam Ratulangi No. 34',
                'city' => 'Manado',
                'province' => 'Sulawesi Utara',
                'postal_code' => '95111',
                'phone' => '0431-234567',
                'email' => 'manado@betonquality.com',
                'manager_name' => 'Robert Tambunan',
                'is_active' => false, // Another inactive for testing
                'latitude' => '1.4917007',
                'longitude' => '124.8397319',
            ]
        ];

        foreach ($branches as $branchData) {
            Branch::create($branchData);
        }
    }
}
