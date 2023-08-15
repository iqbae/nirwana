<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital Patient Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
</head>
<body onload="window.print()" >
    {{--  Header  --}}
    <h2 align="center" >
        <img style="position: absolute left; margin-top:10px;margin-right:700px;margin-bottom:10px;"  height="60" src="{{ asset('/assets/backsite/app-assets/images/logo/nirwana.png') }}" alt="Logo">
        <center style="margin-top: -100px;">
        <br>RUMAH SAKIT UMUM NIRWANA <br>
        <small style="font-size: 12px;"> Jalan Panglima Batur Timur Nomor 42 Banjarbaru Kalimantan Selatan<small>
        <br>Telepon (0511) 6749272 E-mail : rsu.nirwana@gmail.com</center>
        </h2>

        <hr style="border: 2; border-top: solid 3.5px #000000;">
        <div id="title">
            <h3>PASIEN RUMAH SAKIT</h3>
        </div>
        <br>

        {{-- table card --}}
        @can('doctor_table')
            <section>
                <!-- Zero configuration table -->
                <div class="row">
                    <div id="isi">               
                                 <table align="center" width="86%" id="isit" class="grid" style="border:0.2mm solid #000; style="font-size: 20px;"">
                                            
                                            <thead style="font-size: 20px;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date Record</th> 
                                                    <th>Patient Name</th>
                                                    <th>No Telp</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 20px;">
                                                @forelse($hospital_patient as $key => $patient_item)
                                                <tr data-entry-id="{{ $patient_item->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ isset($patient_item->created_at) ? date("d/m/Y H:i:s",strtotime($patient_item->created_at)) : '' }}</td>
                                                            <td>{{ $patient_item->name ?? '' }}</td>
                                                            <td>{{ $patient_item->detail_user->contact ?? '' }}</td>
                                                            <td>{{ $patient_item->detail_user->address ?? '' }}</td>
                                                            <td>{{ $patient_item->email ?? '' }}</td>
                                                        </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                            </tbody>  
                                </table>
                        </div>
                    </div>
            </section>
    @endcan
</body>
</html>