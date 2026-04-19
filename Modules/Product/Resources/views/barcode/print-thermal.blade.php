<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcodes - Thermal</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .page {
            width: 58mm; /* sesuaikan dengan lebar kertas thermal (58mm/80mm) */
            margin: 0 auto;
        }
        .label-item {
            width: 100%;
            border: 1px dashed #000000;
            background-color: #ffffff;
            margin: 2mm 0;
            padding: 1mm 1mm 2mm 1mm;
            text-align: center;
        }
        .label-item .name {
            font-size: 9px;
            margin: 0 0 1mm 0;
            color: #000;
            word-wrap: break-word;
        }
        .label-item .barcode-linear {
            margin-bottom: 1mm;
        }
        .label-item .barcode-linear svg {
            width: 100%;
            height: auto;
        }
        .label-item .barcode-qr {
            display: flex;
            justify-content: center;
            margin-top: 4mm;
            margin-left: 20mm;
        }
        .label-item .barcode-qr svg {
            width: 100%;
            height: 34mm;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .page {
                width: 58mm;
                margin: 0;
            }
            .label-item {
                page-break-after: always; /* 1 label = 1 halaman saat print */
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body>
<div class="page">
    @foreach($barcodes as $barcode)
        <div class="label-item">
            <p class="name">{{ $barcode['product']->product_name }}</p>
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
</body>
</html>
