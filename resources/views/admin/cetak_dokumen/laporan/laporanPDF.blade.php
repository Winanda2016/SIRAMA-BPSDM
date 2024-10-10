<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <style>
        .title h1 {
            margin: 0px 0px 10px 0px;
            text-align: center;
            color: #000;
        }

        .title h4 {
            font-weight: 16px;
            margin: 0px 0px 10px 0px;
            text-align: center;
            color: #000;
        }

        .title p {
            font-weight: 16px;
            margin: 0px 0px 20px 0px;
            text-align: center;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12px;
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1>LAPORAN TRANSAKSI</h1>
        <h4>Sistem Informasi Asrama (SIRAMA)</h4>
        <p><b>Tanggal : {{ now()->format('d-m-Y') }}</b></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Transaksi</th>
                <th>Nama Instansi</th>
                <th>Total Hari</th>
                <th>Total Harga</th>
                <th>Status Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $key => $t)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $t->nama }}</td>
                @if ($t->jenis_transaksi === 'kamar')
                <td>Kamar</td>
                @elseif ($t->jenis_transaksi === 'ruangan')
                <td>{{ ($t->nama_ruangan) }}</td>
                @endif
                <td>{{ $t->nama_instansi }}</td>
                <td>{{ isset($total_hari[$t->transaksi_id]) ? $total_hari[$t->transaksi_id] : 0 }} Hari</td>
                <td>Rp. {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                <td>{{ ($t->status_transaksi) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>