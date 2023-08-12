<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
    
</head>

{{--  <body onload="window.print()">  --}}

    {{--  Header  --}}
    <h2 align="center">
        <img style="position: absolute left; margin-top:10px;margin-right:700px;margin-bottom:10px;" height="60"
            src="{{ asset('/assets/backsite/app-assets/images/logo/nirwana.png') }}" alt="Logo">
        <center style="margin-top: -100px;">
            <br>RUMAH SAKIT UMUM NIRWANA <br>
            <small style="font-size: 12px;"> Jalan Panglima Batur Timur Nomor 42 Banjarbaru Kalimantan Selatan<small>
                    <br>Telepon (0511) 6749272 E-mail : rsu.nirwana@gmail.com
        </center>
    </h2>
  



<div class="content my-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cetak Appointments by Doctor: {{ $selectedDoctor->name }}</h4>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>tanggal</th>
                                    <th style="width: 15%">Nama Pasien</th>
                                    <th>Layanan</th>
                                    <th>Keluhan</th>
                                    {{--  Add more columns here as needed  --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->user->name }}</td>
                                    <td>@if ($appointment->level == 1)
                                    <span>{{ 'Umum' }}</span>
                                @elseif($appointment->level == 2)
                                    <span>{{ 'BPJS' }}</span>
                                @endif</td>
                                    <td>{{ $appointment->complaint }}</td>
                                    {{-- Add more columns here as needed --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>