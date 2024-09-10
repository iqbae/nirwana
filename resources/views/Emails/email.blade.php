<h1>Konfirmasi Janji Temu</h1>
<p>Terima kasih telah membuat janji temu dengan kami.</p>
<p><strong>Dokter:</strong> {{ $appointment->doctor->name }}</p>
<p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</p>
<p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</p>
<p><strong>Nomor Antrian:</strong> {{ $appointment->queue_number }}</p>
<p>Kami menantikan kehadiran Anda.</p>
<p>Terima kasih,</p>
<p>{{ config('app.name') }}</p>
