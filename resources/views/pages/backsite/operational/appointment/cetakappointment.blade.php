<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
    
</head>

<body onload="window.print()" >
    <h2 align="center">
        <img style="position: absolute left; margin-top:10px;margin-right:700px;margin-bottom:10px;" height="60"
            src="{{ asset('/assets/backsite/app-assets/images/logo/nirwana.png') }}" alt="Logo">
        <center style="margin-top: -100px;">
            <br>RUMAH SAKIT UMUM NIRWANA <br>
            <small style="font-size: 12px;"> Jalan Panglima Batur Timur Nomor 42 Banjarbaru Kalimantan Selatan<small>
                    <br>Telepon (0511) 6749272 E-mail : rsu.nirwana@gmail.com
        </center>
        <hr style="border: 2; border-top: solid 3.5px #000000;">

    </h2>
    <div class="table-responsive">
        <table class=" fs-5 table table-striped text-inputs-searching default-table">
            <thead>
                {{--  <tr>
                    <th>Date</th>
                    <td>{{ isset($transaction->created_at) ? date("d/m/Y H:i:s",strtotime($transaction->created_at)) : '' }}</td>
                </tr>  --}}
                <tr>
                    <th>Nama Dokter </th>
                    <td>{{ isset($appointment->doctor->name) ? $appointment->doctor->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Nama Pasien</th>
                    <td>{{ isset($appointment->user->name) ? $appointment->user->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ isset($appointment->date) ? $appointment->date : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Layanan</th>
                    <td>
                        @if ($appointment->level == 1)
                        {{ 'Sudah Bayar' }}
                    @elseif($appointment->level == 2)
                        {{ 'Belum Bayar' }}
                    @else
                        <span>{{ 'N/A' }}</span>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ isset($appointment->time) ? $appointment->time : 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="width: 15%">Complaint</th>
                    <td>{{ isset($appointment->complaint) ? $appointment->complaint : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status Bayar</th>
                    <td>
                        @if ($appointment->status == 1)
                        {{ 'Sudah Bayar' }}
                    @elseif($appointment->status == 2)
                        {{ 'Belum Bayar' }}
                    @else
                        <span>{{ 'N/A' }}</span>
                    @endif
                </td>
                </tr>

                
            </thead>
            
            
                {{--  @forelse($transaction as $key => $transaction_item)
                    <tr data-entry-id="{{ $transaction_item->id }}">
                        <td>{{ isset($transaction_item->created_at) ? date("d/m/Y H:i:s",strtotime($transaction_item->created_at)) : '' }}</td>
                        <td>{{ $transaction_item->appointment->doctor->name ?? '' }}</td>
                        <td>{{ $transaction_item->appointment->user->name ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->fee_doctor) ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->fee_specialist) ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->fee_hospital) ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->sub_total) ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->vat) ?? '' }}</td>
                        <td>{{ 'Rp. '.number_format($transaction_item->total) ?? '' }}</td>
                        <td>
                            @if ($transaction_item->appointment->status == 1)
                            <span class="text-success">{{ 'Sudah Bayar' }}</span>
                        @elseif($transaction_item->appointment->status == 2)
                            <span class="text-warning">{{ 'Belum Bayar' }}</span>
                        @else
                            <span>{{ 'N/A' }}</span>
                        @endif
                        </td>
                    </tr>
                @empty
                    
                @endforelse  --}}
            

        </table>
    </div>
</body>

</html>
