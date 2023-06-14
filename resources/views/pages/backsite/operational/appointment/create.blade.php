<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Report</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
</head>
<body onload="window.print()" >
    
    {{--  Header  --}}
    <h2 align="center" >
        <img style="position: absolute left; margin-top:10px;margin-right:600px;margin-bottom:10px;"  height="60" src="{{ asset('/assets/backsite/app-assets/images/logo/nirwana.png') }}" alt="Logo">
        <center style="margin-top: -100px;">
        <br>RUMAH SAKIT UMUM NIRWANA <br>
        <small style="font-size: 12px;"> Jalan Panglima Batur Timur Nomor 42 Banjarbaru Kalimantan Selatan<small>
        <br>Telepon (0511) 6749272 E-mail : rsu.nirwana@gmail.com</center>
        </h2>

        <hr style="border: 2; border-top: solid 3.5px #000000;">
        <div id="title">
            <h3><u>APPOINTMENT REPORT</u></h3>
        </div>
        <br>

        {{-- table card --}}
        @can('doctor_table')
            <section>
                <!-- Zero configuration table -->
                <div class="row">
                    <div id="isi">               
                                 <table align="center" width="86%" id="isit" class="grid" style="border:0.2mm solid #000;">
                                            
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                            <th>Doctor</th>
                                                            <th>Patient</th>
                                                            <th>Consultation</th>
                                                            <th>Level</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($appointment as $key => $appointment_item)
                                                            <tr data-entry-id="{{ $appointment_item->id }}">
                                                                <td>{{ isset($appointment_item->created_at) ? date("d/m/Y H:i:s",strtotime($appointment_item->created_at)) : '' }}</td>
                                                                <td>{{ $appointment_item->doctor->name ?? '' }}</td>
                                                                <td>{{ $appointment_item->user->name ?? '' }}</td>
                                                                <td>{{ $appointment_item->consultation->name ?? '' }}</td>
                                                                <td>
                                                                    @if($appointment_item->level == 1)
                                                                        <span class="badge badge-info">{{ 'Low' }}</span>
                                                                    @elseif($appointment_item->level == 2)
                                                                        <span class="badge badge-warning">{{ 'Medium' }}</span>
                                                                    @elseif($appointment_item->level == 3)
                                                                        <span class="badge badge-danger">{{ 'High' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ isset($appointment_item->date) ? date("d/m/Y",strtotime($appointment_item->date)) : '' }}</td>
                                                                <td>{{ isset($appointment_item->time) ? date("H:i:s",strtotime($appointment_item->time)) : '' }}</td>
                                                                <td>
                                                                    @if($appointment_item->status == 1)
                                                                        <span class="badge badge-success">{{ 'Payment Completed' }}</span>
                                                                    @elseif($appointment_item->status == 2)
                                                                        <span class="badge badge-warning">{{ 'Waiting Payment' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
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