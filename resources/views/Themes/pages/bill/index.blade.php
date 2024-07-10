<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path(' fonts/dejavu-sans/DejaVuSans.ttf') }}') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }


        .bill {
            width: 500px;
            margin: 0 auto;
            padding: 10mm;
            background: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt {
            text-align: center;
        }

        .receipt-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .receipt-header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .receipt-title h3 {
            margin: 20px 0;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 5px;
        }

        .receipt-info p {
            text-align: left;
            font-size: 14px;
            margin: 2px 0;
        }

        .receipt-items table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .receipt-items th,
        .receipt-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .receipt-items th {
            background: #f4f4f4;
            font-size: 14px;
            font-weight: bold;
        }

        .receipt-items td {
            font-size: 14px;
        }

        .receipt-totals {
            text-align: right;
            margin-top: 10px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin: 5px 0;
            font-size:  14px;
        }


        .receipt-footer {
            text-align: center;
            margin-top: 20px;
        }

        .receipt-footer p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: bold;
        }

        .receipt-footer img {
            margin-top: 10px;
        }

        @media print {
            .bill {
                width: 100%;
                box-shadow: none;
                border: none;
            }

            .receipt-title h3 {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <div id="bill" class="bill">
        <div class="content">
            <div class="receipt">
                <div class="receipt-header">
                    <h2>{{ isset($config) ? $config->name : '' }}</h2>
                    <p>Địa chỉ: {{ isset($config) ? $config->address : '' }}</p>
                    <p>Điện thoại: {{ isset($config) ? $config->phone : '' }}</p>
                </div>
                <div class="receipt-title">
                    <h3>Phiếu Tạm Thu</h3>
                </div>
                <div class="receipt-info">
                    <p>Ngày tạo: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                    <p>Tên khách: {{ $client->name }}</p>
                    <p>Số điện thoại: {{ $client->phone }}</p>
                    <p>Tên thu ngân: {{ $user->name }}</p>
                </div>
                <div class="receipt-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item )
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ number_format($item->product->priceBuy) }} VND</td>
                                <td>{{ number_format($item->product->priceBuy * $item->amount) }} VND</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="receipt-totals">
                    <div class="total">
                        <span style="float: left;">Tổng cộng</span>
                        <span>{{ number_format($sum) }} VND</span>
                    </div>
                    <hr>
                    <div class="total">
                        <span style="float: left;">Tổng tiền phải trả  </span>
                        <span>{{ number_format($sum) }} VND</span>
                    </div>
                    <hr>
                    <div class="total">
                        <span style="float: left;">Còn phải trả  </span>
                        <span>{{ number_format($sum) }} VND</span>
                    </div>
                </div>
                <div class="receipt-footer">
                    <p style='margin: 0px;'>Cảm ơn quý khách!</p>
                    @if (isset($config))
                    <img style="width: 200px;" src="{{ $config->qr }}"
                    alt="QR Code">
                    <div>
                        <p>{{ $config->bank->code }} - {{ $config->tin }} - {{  $config->name }}</p>
                    </div>
                    @else
                    <img style="width: 200px;" src="" alt="QR Code">
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
