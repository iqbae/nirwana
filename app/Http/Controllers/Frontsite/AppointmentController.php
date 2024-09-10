<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;


// use library here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
// use everything here
// use Gate;
use Auth;
use Carbon\Carbon;
// use model here
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\Operational\Appointment;
use App\Models\MasterData\Specialist;
use App\Models\MasterData\Consultation;
use App\Notifications\AppointmentReminder;
// thirdparty package

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
    
        // Periksa apakah user_id ada di data
        if (!array_key_exists('user_id', $data)) {
            return redirect()->back()->with('error', 'User ID tidak ditemukan.');
        }
    
        // Temukan dokter berdasarkan ID
        $doctor = Doctor::find($data['doctor_id']);
    
        if (!$doctor) {
            return redirect()->back()->with('error', 'Dokter tidak ditemukan.');
        }
        // Tentukan hari dalam minggu (misalnya, 'monday', 'Tuesday ', dll.)
        $day = strtolower(Carbon::parse($data['date'])->format('l'));
    
        // Dapatkan waktu mulai dokter untuk hari tertentu
        $start_time = Carbon::parse($doctor->$day, 'Asia/Jakarta');
    
        // Hitung jumlah antrian (queue_number) pada tanggal yang dipilih
        $queueCount = Appointment::where('date', $data['date'])->count();

        if ($queueCount >= 10) {
            return redirect()->back()->with('error', 'Antrian sudah penuh untuk tanggal ini. Silakan pilih tanggal lain.')->withInput();
        }
    
        // Dapatkan janji temu yang sudah ada untuk dokter pada tanggal tertentu
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->where('date', $data['date'])
            ->orderBy('time', 'asc')
            ->get();
    
        // Tentukan waktu janji temu
        if ($appointments->isEmpty()) {
            // Jika tidak ada janji temu, janji temu pertama adalah pada waktu mulai
            $appointment_time = $start_time;
        } else {
            // Jika ada janji temu yang sudah ada, janji temu baru adalah 30 menit setelah yang terakhir
            $last_appointment = $appointments->last();
            $appointment_time = Carbon::parse($last_appointment->time, 'Asia/Jakarta')->addMinutes(30);
        }
    
         // Tentukan nomor antrian
        $queue_number = $appointments->count() + 1;

        // Buat janji temu baru
        $appointment = new Appointment();
        $appointment->doctor_id = $data['doctor_id'];
        $appointment->user_id = $data['user_id'];
        $appointment->level = $data['level_id'];
        $appointment->date = $data['date'];
        $appointment->time = $appointment_time->format('H:i:s');
        $appointment->status = '2'; // Asumsi '2' berarti menunggu pembayaran
        $appointment->created_at = now();
        $appointment->updated_at = now();
        $appointment->complaint = $data['complaint'];
        $appointment->queue_number = $queue_number; // Menetapkan nomor antrian
        $appointment->save();
    
        // Kirim email konfirmasi
        $user = Auth::user(); // Asumsi pengguna yang sedang login adalah pasien
        Mail::to($user->email)->send(new SendEmail($appointment));

        // Respon sukses
        alert()->success('Sukses', 'Janji temu berhasil dijadwalkan');
        return redirect()->route('payment.appointment', $appointment->id);
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }


    // custom

    public function appointment($id)
    {
        $doctor = Doctor::where('id', $id)->first();
        // $consultation = Consultation::orderBy('name', 'asc')->get();        , 'consultation'

        return view('pages.frontsite.appointment.index', compact('doctor'));
    }  
    

}
