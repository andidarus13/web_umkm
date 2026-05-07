<!DOCTYPE html>
<html>
<head>
    <title>Laporan Merchant</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h3 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

<h3>Laporan Merchant</h3>
<p>Tanggal: {{ date('d M Y') }}</p>

<table>
<tr>
    <th>No</th>
    <th>Nama Toko</th>
    <th>Status</th>
    <th>Total Produk</th>
</tr>

@foreach($merchants as $i => $m)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $m->store_name }}</td>
    <td>{{ $m->is_verified ? 'Verified' : 'Pending' }}</td>
    <td>{{ $m->products_count }}</td>
</tr>
@endforeach

</table>

</body>
</html>