<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// use library here
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// use everything here
use Gate;
use Auth;

//requests
use App\Http\Requests\Appointment\UpdateAppointmentRequest;

// use model here
use App\Models\Operational\Appointment;
use App\Models\Operational\Doctor;
use App\Models\Operational\Transaction;
use App\Models\User;
use App\Models\MasterData\Consultation;

// thirdparty package

class ReportAppointmentController extends Controller
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
    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_user_condition = Auth::user()->detail_user->type_user_id;

        // Filter by dokter
        $doctor = Doctor::all();
        $selectedDoctorId = $request->query('doctor_filter');
        $selectedType = $request->query('type'); // Ambil nilai query parameter 'type'

        if ($selectedDoctorId) {
            $appointment = Appointment::where('doctor_id', $selectedDoctorId)->orderBy('created_at', 'desc')->get();
        } else {
            $query = Appointment::query();

            // Jika ada query parameter 'type', filter berdasarkan tipe (UMUM atau BPJS)
            if ($selectedType && in_array($selectedType, ['UMUM', 'BPJS'])) {
                $query->where('level', ($selectedType === 'UMUM' ? 1 : 2));
            }

            $appointment = $query->orderBy('created_at', 'desc')->get();
        }

        return view('pages.backsite.operational.appointment.index', compact('appointment', 'doctor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //      $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     if ($start_date && $end_date) {
    //         $appointment = Appointment::whereBetween('date', [$start_date, $end_date]);
    //     }

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
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $appointment = Appointment::findOrFail($id);
        return view('pages.backsite.operational.appointment.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {

        $appointment = Appointment::find($appointment['id']);
        $appointment->status = 1; // set to completed payment
        $appointment->save();

        alert()->success('Success Message', 'Berhasil mengubah status pemabayaran');
        return redirect()->route('backsite.appointment.index');;
        // abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //     $appointment = Appointment::orderBy('created_at', 'desc')->get();
        //     $doctor = Doctor::orderBy('name', 'asc')->get();


        // return view('pages.backsite.operational.appointment.edit', compact('appointment', 'doctor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, appointment $appointment)
    {
        $data = $request->all();

        $appointment->update($data);

        alert()->success('Success Message', 'Berhasil mengubah janji');
        return redirect()->route('backsite.appointment.index');
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

    // custom function

    public function cetak(appointment $appointment)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_user_condition = Auth::user()->detail_user->type_user_id;

        if ($type_user_condition == 1) {
            // for admin
            $appointment = Appointment::orderBy('created_at', 'desc')->get();
        } else {
            // other admin for doctor & patient ( task for everyone here )
            $appointment = Appointment::orderBy('created_at', 'desc')->get();
        }

        return view('pages.backsite.operational.appointment.cetak', compact('appointment'));
    }

    public function cetakappointment($id)
    {

        $appointment = Appointment::where('id', $id)->first();
        $transaction = Transaction::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.operational.appointment.cetakappointment', compact('transaction', 'appointment'));
    }

    public function cetakBpjs()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Filter the data to get BPJS appointments only (level 2)
        $appointment = Appointment::where('level', 2)->orderBy('created_at', 'desc')->get();

        return view('pages.backsite.operational.appointment.cetakBpjs', compact('appointment'));
    }


    public function cetakUmum()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Filter the data to get BPJS appointments only (level 2)
        $appointment = Appointment::where('level', 1)->orderBy('created_at', 'desc')->get();

        return view('pages.backsite.operational.appointment.cetakUmum', compact('appointment'));
    }


    public function cetakFilterDokter(Request $request)
    {
        // Mendapatkan id dokter yang dipilih dari parameter request
        $doctorId = $request->input('doctor_filter');

        // Jika tidak ada dokter yang dipilih, redirect kembali ke halaman sebelumnya
        if (!$doctorId) {
            return redirect()->back()->with('error', 'Please select a doctor.');
        }

        // Mendapatkan data dokter berdasarkan id yang dipilih
        $selectedDoctor = Doctor::find($doctorId);

        // Mendapatkan data appointment yang sesuai dengan dokter yang dipilih
        $appointments = Appointment::where('doctor_id', $doctorId)->orderBy('created_at', 'desc')->get();

        // Load view cetakfilterdokter dengan data yang diperlukan
        return view('pages.backsite.operational.appointment.cetakfilterdokter', compact('selectedDoctor', 'appointments'));
    }


    public function reportfilter(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_user_condition = Auth::user()->detail_user->type_user_id;

        // Filter by dokter
        // Filter by dokter
        $doctor = Doctor::all();
        $selectedDoctorId = $request->input('doctor_filter');

        $appointmentQuery = Appointment::query();

        if ($selectedDoctorId) {
            $appointmentQuery->where('doctor_id', $selectedDoctorId)->orderBy('created_at', 'desc');
        } else {
            $appointmentQuery->orderBy('created_at', 'desc');
        }

        $appointment = $appointmentQuery->get();

        return view('pages.backsite.operational.appointment.reportfilter', compact('appointment', 'doctor'));
    }
}
