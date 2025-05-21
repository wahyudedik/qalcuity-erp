<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Cabang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 5px 0;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .meta-info {
            margin-bottom: 15px;
        }

        .meta-info table {
            width: auto;
            border: none;
        }

        .meta-info table td {
            border: none;
            padding: 3px 10px 3px 0;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
        }

        .stats-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .stats-table td {
            width: 33%;
            text-align: center;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .stats-value {
            font-size: 16px;
            font-weight: bold;
            display: block;
        }

        .stats-label {
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Data Cabang</h1>
        <p>Tanggal: {{ $generatedAt->format('d F Y') }}</p>
        <p>Waktu: {{ $generatedAt->format('H:i:s') }}</p>
    </div>

    <div class="meta-info">
        <table>
            @if(!empty($filters['city']))
                <tr>
                    <td><strong>Kota:</strong></td>
                    <td>{{ $filters['city'] }}</td>
                </tr>
            @endif
            @if(!empty($filters['province']))
                <tr>
                    <td><strong>Provinsi:</strong></td>
                    <td>{{ $filters['province'] }}</td>
                </tr>
            @endif
            @if(isset($filters['is_active']))
                <tr>
                    <td><strong>Status:</strong></td>
                    <td>{{ $filters['is_active'] ? 'Aktif' : 'Tidak Aktif' }}</td>
                </tr>
            @endif
        </table>
    </div>

    @if(isset($statistics) && count($statistics) > 0)
        <table class="stats-table" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <span class="stats-value">{{ $statistics['total'] ?? 0 }}</span>
                    <span class="stats-label">Total Cabang</span>
                </td>
                <td>
                    <span class="stats-value">{{ $statistics['active'] ?? 0 }}</span>
                    <span class="stats-label">Cabang Aktif</span>
                </td>
                <td>
                    <span class="stats-value">{{ $statistics['inactive'] ?? 0 }}</span>
                    <span class="stats-label">Cabang Tidak Aktif</span>
                </td>
            </tr>
        </table>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Cabang</th>
                <th>Kode</th>
                <th>Kota</th>
                <th>Provinsi</th>
                <th>Manager</th>
                <th>Status</th>
                <th>Jml. Pengguna</th>
            </tr>
        </thead>
        <tbody>
            @forelse($branches as $index => $branch)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->code }}</td>
                    <td>{{ $branch->city ?? '-' }}</td>
                    <td>{{ $branch->province ?? '-' }}</td>
                    <td>{{ $branch->manager_name ?? '-' }}</td>
                    <td class="{{ $branch->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $branch->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </td>
                    <td>{{ $branch->users_count ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data cabang</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan dibuat pada {{ $generatedAt->format('d F Y H:i:s') }}</p>
        <p>© {{ date('Y') }} Qalcuity ERP - Manajemen Cabang</p>
    </div>
</body>

</html>
