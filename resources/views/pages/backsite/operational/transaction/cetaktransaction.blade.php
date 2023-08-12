<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/backsite/app-assets/css/report.css') }}" />
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

</head>


<body onload="window.print()">
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

        <div id="title">
            <h3>INVOICE</h3>
        </div>
        <br>
    <div class="table-responsive">
        <table class=" fs-5 table table-striped table-bordered text-inputs-searching default-table">
            <thead>
                {{--  <tr>
                    <th>Date</th>
                    <td>{{ isset($transaction->created_at) ? date("d/m/Y H:i:s",strtotime($transaction->created_at)) : '' }}</td>
                </tr>  --}}
                <tr>
                    <th>Nama Dokter </th>
                    <td>{{ isset($transaction->appointment->doctor->name) ? $transaction->appointment->doctor->name : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th>Nama Pasien</th>
                    <td>{{ isset($transaction->appointment->user->name) ? $transaction->appointment->user->name : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th>Fee Dokter</th>
                    <td>{{ 'Rp. ' . number_format($transaction->fee_doctor) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fee Spesialis</th>
                    <td>{{ 'Rp. ' . number_format($transaction->fee_specialist) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fee Rumah Sakit</th>
                    <td>{{ 'Rp. ' . number_format($transaction->fee_hospital) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Sub total</th>
                    <td>{{ 'Rp. ' . number_format($transaction->sub_total) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Vat</th>
                    <td>{{ 'Rp. ' . number_format($transaction->vat) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="fw-bolder">{{ 'Rp. ' . number_format($transaction->total) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Status Bayar</th>
                    <td>
                        @if ($transaction->appointment->status == 1)
                            <span class="text-success">{{ 'Sudah Bayar' }}</span>
                        @elseif($transaction->appointment->status == 2)
                            <span class="text-warning">{{ 'Belum Bayar' }}</span>
                        @else
                            <span>{{ 'N/A' }}</span>
                        @endif
                    </td>
                </tr>

                </tr>
            </thead>




        </table>
        <div class="table-responsive" style="margin-top: 80px;">
            <table class="fs-5 align-middle table-borderless table ">

                <tr>
                    <td >
                        {{ isset($transaction->appointment->user->name) ? $transaction->appointment->user->name : 'N/A' }}
                    </td>
                    <td>{{ Auth::user()->name }}<br>(KASIR)</td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>
