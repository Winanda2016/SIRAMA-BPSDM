<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Transaksi</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            color: #000;
        }


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

        body a {
            color: #06f;
        }

        .card {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
            width: 20%;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color:#000;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table .total{
            font-weight: bold;
            text-align: right;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="title">
        <h1>Faktur Transaksi</h1>
        <h4>Badan Pengembangan Sumber Daya Manusia (BPSDM) Prov.Sumbar</h4>
        <p><b>Tanggal : {{ now()->format('d-m-Y') }}</b></p>
    </div>

    <div class="container">
        <div class="card">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $transaksi->nama }}</td>
                </tr>
                <tr>
                    <td>Asal Instansi</td>
                    <td>: {{ $transaksi->nama_instansi }}</td>
                </tr>
                <tr>
                    <td>Nomor Hp</td>
                    <td>: {{ $transaksi->nohp }}</td>
                </tr>
            </table>

            <div class="invoice-box">
                <table>
                    <tr class="heading">
                        <td>Title</td>
                        <td colspan="2">Description</td>
                    </tr>

                    <tr class="item">
                        <td>Tanggal Check-in</td>
                        <td colspan="2">{{$transaksi->tgl_checkin}}</td>
                    </tr>

                    <tr class="item">
                        <td>Tanggal Check-out</td>
                        <td colspan="2">{{$transaksi->tgl_checkout}}</td>
                    </tr>

                    <tr class="item">
                        <td>Jumlah Orang</td>
                        <td colspan="2">{{ $transaksi->jumlah_orang }} Orang</td>
                    </tr>

                    <tr class="item">
                        <td>Jumlah Hari</td>
                        <td colspan="2">{{ $total_hari }} Hari</td>
                    </tr>

                    <tr class="item">
                        <td>Harga per-hari</td>
                        <td colspan="2">Rp. {{ number_format($harga_per_hari, 0, ',', '.') }}</td>
                    </tr>

                    <tr class="total">
                        <td colspan="2">Subtotal: </td>
                        <td>Rp. {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                    </tr>

                    <tr class="total">
                        <td colspan="2">Diskon: </td>
                        <td>{{$transaksi->diskon}}%</td>
                    </tr>

                    <tr class="total">
                        <td colspan="2">Total: </td>
                        <td>{{$transaksi->formatted_harga}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


</body>

</html>