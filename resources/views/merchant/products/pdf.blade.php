<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk</title>
</head>
<body>

<h2>Laporan Produk</h2>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category->name ?? '-' }}</td>
        <td>{{ $p->price }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>