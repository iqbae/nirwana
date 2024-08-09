
<table class="table table-bordered">
    <tr>
        <th>Specialist</th>
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
        <th style="height: 200px">Photo</th>
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

<table class="table table-bordered">
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
            <td>{{ $doctor->monday ?? '' }}</td>
            <td>{{ $doctor->tuesday ?? '' }}</td>
            <td>{{ $doctor->wednesday ?? '' }}</td>
            <td>{{ $doctor->thursday ?? '' }}</td>
            <td>{{ $doctor->friday ?? '' }}</td>
            <td>{{ $doctor->saturday ?? '' }}</td>
        </tr>
    </tbody>
</table>