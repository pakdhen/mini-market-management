<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Detail Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pengguna</th>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->price }}</td>
                        <td>{{ $detail->quantity * $detail->price }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>