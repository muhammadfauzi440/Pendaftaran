<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendaftaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 9px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .header p {
            margin: 5px 0;
            font-size: 10px;
            color: #666666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-diterima {
            color: #059669;
        }

        .status-pending {
            color: #d97706;
        }

        .status-ditolak {
            color: #dc2626;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Pendaftaran</h2>
        <p>Total Pendaftar: {{ $pendaftarans->count() }} | Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Instansi</th>
                <th>Kategori</th>
                <th>NIM / NISN</th>
                <th>Jurusan</th>
                <th>Durasi</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftarans as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->user->name ?? 'N/A' }}</td>
                    <td>{{ $p->user->email ?? 'N/A' }}</td>
                    <td>{{ $p->instansi->nama_instansi ?? 'N/A' }}</td>
                    <td>{{ ucfirst($p->kategori) }}</td>
                    <td>{{ $p->nim_nisn }}</td>
                    <td>{{ $p->jurusan }}</td>
                    <td>{{ $p->durasi_bulan }} Bulan</td>
                    <td>{{ $p->tanggal_mulai->format('d/m/Y') }}</td>
                    <td>{{ $p->tanggal_selesai->format('d/m/Y') }}</td>
                    <td class="status status-{{ $p->status }}">
                        {{ strtoupper($p->status) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>
</body>

</html>
