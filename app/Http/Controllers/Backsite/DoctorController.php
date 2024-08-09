<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// use library here
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;

// use everything here
use Gate;
use Auth;
use File;

// use model here 
use App\Models\Operational\Doctor;
use App\Models\MasterData\Specialist;

// thirdparty package

class DoctorController extends Controller
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
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = Doctor::orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
    
        $doctor = $query->get();

        // for select2 = ascending a to z
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.index', compact('doctor', 'specialist'));
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
    public function store(StoreDoctorRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        $data['fee'] = str_replace(['Rp. ', ','], '', $data['fee']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('assets/file-doctor', 'public');
        } else {
            $data['photo'] = '';
        }

        // store to database
        $doctor = Doctor::create($data);

        alert()->success('Success Message', 'Successfully added new doctor');
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.operational.doctor.show', compact('doctor'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for select2 = ascending a to z
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.edit', compact('doctor', 'specialist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        // get all request from frontsite
        $data = $request->all();
        $data['fee'] = str_replace(['Rp. ', ','], '', $data['fee']);

          if ($request->hasFile('photo')) {
        $oldPhoto = $doctor->photo;
        $data['photo'] = $request->file('photo')->store('assets/file-doctor', 'public');

        if (File::exists('storage/' . $oldPhoto)) {
            File::delete('storage/' . $oldPhoto);
        } else {
            File::delete('storage/app/public/' . $oldPhoto);
        }
    }


        // update to database
        $doctor->update($data);

        alert()->success('Success Message', 'Successfully updated doctor');
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // first checking old file to delete from storage
        $get_item = $doctor['photo'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        $doctor->forceDelete();

        alert()->success('Success Message', 'Successfully deleted doctor');
        return back();
    }
// custom function
    public function cetakjadwal(Doctor $doctor){

        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for table grid
        $doctor = Doctor::orderBy('created_at', 'desc')->get();

        // for select2 = ascending a to z
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.cetakjadwal', compact('doctor', 'specialist'));
    

    }

    public function cetakdokter($id){

        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for table grid
        $doctor = Doctor::where('id', $id)->first();

        // for select2 = ascending a to z
        $specialist = Specialist::orderBy('name', 'asc')->get();


        return view('pages.backsite.operational.doctor.cetakdokter', compact('doctor', 'specialist'));
    

    }

    public function cetak(){

        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for table grid
        $doctor = Doctor::orderBy('created_at', 'desc')->get();

        // for select2 = ascending a to z
        $specialist = Specialist::orderBy('name', 'asc')->get();
        
        return view('pages.backsite.operational.doctor.cetak', compact('doctor', 'specialist'));

    }
}
