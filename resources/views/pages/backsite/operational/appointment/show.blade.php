<div class="table-responsive">
    <table class="fs-5 table table-striped text-inputs-searching default-table">
        <thead>
            {{--  <tr>
                <th>Recorded</th>
                <td>{{ isset($appointment->created_at) ? date("d/m/Y H:i:s",strtotime($appointment->created_at)) : '' }}</td>
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
    </table>
</div>
