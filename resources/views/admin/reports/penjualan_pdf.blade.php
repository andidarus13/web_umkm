<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        p {
            text-align: center;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background: #f2f2f2;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Laporan Produk</h2>
<p>Tanggal: {{ date('d M Y') }}</p>

<table>
<tr>
    <th>No</th>
    <th>Produk</th>
    <th>Merchant</th>
    <th>Kategori</th>
    <th>Harga</th>
</tr>

@foreach($products as $i => $p)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $p->name }}</td>
    <td>{{ $p->merchant->store_name ?? '-' }}</td>
    <td>{{ $p->category->name ?? '-' }}</td>
    <td>Rp {{ number_format($p->price) }}</td>
</tr>
@endforeach

</table>

</body>
</html>