<table class="table table-bordered">
    <tr>
        <th>Doctor</th>
        <td>{{ old('name', isset($transaction) ?  $transaction->appointment->doctor->name : '') }}</td>
    </tr>
    <tr>
        <th>Patient</th>
        <td>{{ old('name', isset($transaction) ?  $transaction->appointment->user->name : '') }}</td>
    </tr>
    <tr>
        <th>Fee Doctor</th>
        <td>Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->fee_doctor) : '') }}</td>
    </tr>
    <tr>
        <th>Fee Spesialist</th>
        <td>Rp. {{ old('fee_specialist', isset($transaction) ? number_format($transaction->fee_specialist) : '') }}</td>
    </tr>
    <tr>
        <th>Fee Hospital</th>
        <td>Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->fee_doctor) : '') }}</td>
    </tr>
    <tr>
        <th>Sub Total</th>
        <td>Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->sub_total) : '') }}</td>
    </tr>
    <tr>
        <th>Vat</th>
        <td>Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->vat) : '') }}</td>
    </tr>
    <tr>
        <th>Total</th>
        <td>Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->total) : '') }}</td>
    </tr>
    <tr>
        <th style="height: 200px">Bukti Bayar</th>
        <td>
            <img src="
                @if ($transaction->bukti != '') @if (File::exists('storage/' . $transaction->bukti))
                        {{ url(Storage::url($transaction->bukti)) }}
                    @else
                       {{ 'N/A' }} @endif
                    @else
                        {{ 'N/A' }}
                @endif "
                alt="doctor photo" class="users-avatar-shadow" height="200">
        </td>
    </tr>
</table>