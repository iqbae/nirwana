<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <script src="{{ mix('js/app.js') }}"></script>
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80mm;
            margin: auto;
            padding: 10mm;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin-top: 10mm;
        }
        .content .item {
            margin-bottom: 5mm;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Struk Pembayaran</h2>
            <p>Rumah Sakit Umum Nirwana</p>
        </div>

        <div class="content">
            <div class="item">
                <span>Dokter:</span>
                <span>{{ $appointment->doctor->name }}</span>
            </div>
            <div class="item">
                <span>Spesialis:</span>
                <span>{{ $appointment->doctor->specialist->name }}</span>
            </div>
            <div class="item">
                <span>Layanan:</span>
                <span>
                    @if ($appointment->level == 1)
                        Umum
                    @elseif ($appointment->level == 2)
                        BPJS
                    @else
                        N/A
                    @endif
                </span>
            </div>
            <div class="item">
                <span>Dijadwalkan pada</span>
                <span>{{ date('d F Y', strtotime($appointment->date)) ?? '' }}
                </span>
            </div>

            <div class="item">
                <span>Waktu</span>
                <span>{{ date('H:i', strtotime($appointment->time)) ?? '' }}</span>
            </div>

            <div class="item">
                <span>Antrian</span>
                <span>{{ ($appointment->queue_number) ?? '' }}</span>
            </div>
            <div class="item">
                <span>Biaya Konsultasi:</span>
                <span>{{ 'Rp. ' . number_format($appointment->doctor->specialist->price) }}</span>
            </div>
            <div class="item">
                <span>Jasa Dokter:</span>
                <span>{{ 'Rp. ' . number_format($appointment->doctor->fee) }}</span>
            </div>
            <div class="item">
                <span>Jasa Rumah Sakit:</span>
                <span>{{ 'Rp. ' . number_format($config_payment->fee) }}</span>
            </div>
            <div class="item">
                <span>PPN:</span>
                <span>{{ $config_payment->vat }}%</span>
            </div>
            <div class="item">
                <span>Total:</span>
                <span>{{ 'Rp. ' . number_format($grand_total) }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>


    <script>
        window.onload = function () {
            html2canvas(document.getElementById('capture')).then(function(canvas) {
                // Membuat elemen link untuk mendownload gambar
                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'receipt.png';
                link.click();
            });
        };
    </script>

</body>
</html>
