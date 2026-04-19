<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcodes</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
    <style>
        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }
        .barcode-item {
            border: 1px dashed #000000;
            background-color: #ffffff;
            padding: 0;
            text-align: center;
            flex: 0 1 auto;
            width: 36mm;
            height: 24mm;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .barcode-item p {
            margin: 0;
            font-size: 8px;
            line-height: 1.2;
            padding: 2px;
        }
        .barcode-item div {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .barcode-item .barcode-linear svg {
            max-width: 34mm;
            max-height: 10mm;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .barcode-item .barcode-qr svg {
            max-width: 16mm;
            max-height: 16mm;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        @media print {
            .container {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
<div class="container">
    <div class="barcode-container">
        @foreach($barcodes as $barcode)
            <div class="barcode-item">
                <p style="color: #000;">
                    {{ $barcode['product']->product_name }}
                </p>
                <div class="barcode-linear">
                    {!! $barcode['barcodePrinted'] !!}
                </div>
                @if(!empty($barcode['qrcodePrinted']))
                    <div class="barcode-qr">
                        {!! $barcode['qrcodePrinted'] !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
