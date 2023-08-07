<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ isset($specialist->name) ? $specialist->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>{{ isset($specialist->price) ? 'Rp. '.number_format($specialist->price) : 'N/A' }}</td>
    </tr>
</table>
