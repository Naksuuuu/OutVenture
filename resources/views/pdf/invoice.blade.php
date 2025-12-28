<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 40px;
        }

        .header {
            margin-bottom: 40px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 5px;
        }

        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            color: #666;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .value {
            font-size: 13px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            background-color: #000;
            color: #fff;
            padding: 12px 8px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 12px 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-name {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .product-details {
            font-size: 10px;
            color: #666;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            margin-top: 30px;
            float: right;
            width: 300px;
        }

        .total-row {
            display: table;
            width: 100%;
            padding: 8px 0;
        }

        .total-label {
            display: table-cell;
            text-align: right;
            padding-right: 20px;
            font-size: 12px;
        }

        .total-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            font-size: 13px;
        }

        .grand-total {
            border-top: 2px solid #000;
            padding-top: 15px;
            margin-top: 10px;
        }

        .grand-total .total-label {
            font-size: 14px;
            font-weight: bold;
        }

        .grand-total .total-value {
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            clear: both;
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #22c55e;
            color: white;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <div class="company-name">OUTVENTURE</div>
        <div style="font-size: 11px; color: #666;">Adventure Gear & Outdoor Equipment</div>
        <div class="invoice-title">INVOICE</div>
    </div>

    {{-- Invoice Info --}}
    <div class="info-section">
        <div class="info-row">
            <div class="info-col">
                <div class="label">Invoice Number</div>
                <div class="value">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-col">
                <div class="label">Status</div>
                <div>
                    @if ($order->status_pembayaran)
                        <span class="status-badge">LUNAS</span>
                    @else
                        <span class="status-badge" style="background-color: #fee2e2; color: #991b1b;">BELUM BAYAR</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="info-row">
            <div class="info-col">
                <div class="label">Tanggal Order</div>
                <div class="value">{{ $order->tgl_order->format('d F Y') }}</div>
            </div>
            <div class="info-col">
                <div class="label">Customer</div>
                <div class="value">{{ $order->user->name }}</div>
                <div style="font-size: 11px; color: #666;">{{ $order->user->email }}</div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <table>
        <thead>
            <tr>
                <th style="width: 50%;">Product</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 17.5%; text-align: right;">Harga</th>
                <th style="width: 17.5%; text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order->items as $item)
                <tr>
                    <td>
                        <div class="product-name">{{ $item->variantSpec->variant->product->nama_product }}</div>
                        <div class="product-details">
                            {{ $item->variantSpec->variant->product->brand->nama_brand ?? 'Brand' }} •
                            {{ $item->variantSpec->variant->color->nama_warna ?? '-' }} •
                            {{ $item->variantSpec->size->label_size ?? '-' }}
                        </div>
                    </td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px; color: #666;">Tidak ada item</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Totals --}}
    <div class="totals">
        <div class="total-row">
            <div class="total-label">Subtotal:</div>
            <div class="total-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
        </div>
        <div class="total-row">
            <div class="total-label">Ongkir:</div>
            <div class="total-value">Gratis</div>
        </div>
        <div class="total-row grand-total">
            <div class="total-label">TOTAL:</div>
            <div class="total-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Terima kasih atas pembelian Anda di OUTVENTURE</p>
        <p>Invoice ini digenerate secara otomatis pada {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>

</html>
