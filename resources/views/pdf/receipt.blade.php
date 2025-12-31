<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran - D'Lima Coffee</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #d2b48c; /* Tan color similar to coffee theme */
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #777;
            font-size: 12px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            color: #555;
            width: 120px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            text-align: left;
            background-color: #f8f8f8;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .items-table .price {
            text-align: right;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            font-size: 16px;
        }
        .total-section .grand-total {
            font-weight: bold;
            font-size: 18px;
            color: #2ca25d; /* Green for paid */
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .badge-paid {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>D'Lima Coffee</h1>
            <p>Jl. Delima, Kota Parepare</p>
            <p>Terima kasih telah memesan!</p>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">ID Pesanan:</td>
                <td>#{{ $order->id }}</td>
                <td class="label">Tanggal:</td>
                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Pelanggan:</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td class="label">Status:</td>
                <td><span class="badge-paid">LUNAS</span></td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th style="width: 15%">Qty</th>
                    <th class="price" style="width: 25%">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->order_items as $item)
                <tr>
                    <td>{{ $item->daftar_menu->nama ?? 'Unknown Item' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td class="price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <p>Total Pembayaran</p>
            <div class="grand-total">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
        </div>

        <div class="footer">
            <p>Simpan dokumen ini sebagai bukti pembayaran yang sah.</p>
            <p>&copy; {{ date('Y') }} D'Lima Coffee. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
