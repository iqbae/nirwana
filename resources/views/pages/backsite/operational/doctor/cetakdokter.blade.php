<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
</head>
<body class="mb-5" onload="window.print()">

<h2 align="center" >
    <img style="position: absolute left; margin-top:10px;margin-right:700px;margin-bottom:10px;"  height="60" src="{{ asset('/assets/backsite/app-assets/images/logo/nirwana.png') }}" alt="Logo">
    <center style="margin-top: -100px;">
    <br>RUMAH SAKIT UMUM NIRWANA <br>
    <small style="font-size: 12px;"> Jalan Panglima Batur Timur Nomor 42 Banjarbaru Kalimantan Selatan<small>
    <br>Telepon (0511) 6749272 E-mail : rsu.nirwana@gmail.com</center>
    </h2>

    <hr style="border: 2; border-top: solid 3.5px #000000;">
    <div id="title">
        <h3>Data Dokter {{ isset($doctor->name) ? $doctor->name : 'N/A' }}</h3>
    </div>
    <br>
    <div class="">
<table class="table table-striped table-hover">
    <tr >
        <th style="width:500px">Specialist</th>
        <td>{{ isset($doctor->specialist->name) ? $doctor->specialist->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($doctor->name) ? $doctor->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Fee</th>
        <td>{{ isset($doctor->fee) ? 'Rp. ' . number_format($doctor->fee) : 'N/A' }}</td>
    </tr>
    <tr>
        <th style="height:200px">Photo</th>
        <td>
            <img src="
                @if ($doctor->photo != '') @if (File::exists('storage/' . $doctor->photo))
                        {{ url(Storage::url($doctor->photo)) }}
                    @else
                       {{ 'N/A' }} @endif
                    @else
                        {{ 'N/A' }}
                @endif "
                alt="doctor photo" class="users-avatar-shadow" height="200">
        </td>
    </tr>
</table>
</div>
<h5>Jadwal dokter {{ isset($doctor->name) ? $doctor->name : 'N/A' }}</h5>
<table class="table table-striped table-hover">
    <thead>
        <tr>

            <th>Senin</th>
            <th>Selasa</th>
            <th>Rabu</th>
            <th>Kamis</th>
            <th>Jumat</th>
            <th>Sabtu</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $doctor->senin ?? '' }}</td>
            <td>{{ $doctor->selasa ?? '' }}</td>
            <td>{{ $doctor->rabu ?? '' }}</td>
            <td>{{ $doctor->kamis ?? '' }}</td>
            <td>{{ $doctor->jumat ?? '' }}</td>
            <td>{{ $doctor->sabtu ?? '' }}</td>
        </tr>
    </tbody>
</table>
</body>