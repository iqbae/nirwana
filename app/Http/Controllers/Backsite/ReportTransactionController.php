<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// use library here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

//request
use App\Http\Requests\Transaction\UpdateTransactionRequest;

// use everything here
use Gate;
use Auth;
use File;

// use model here
use App\Models\Operational\Transaction;
use App\Models\Operational\Appointment;
use App\Models\Operational\Doctor;
use App\Models\User;
use App\Models\ManagementAccess\DetailUser;
use App\Models\MasterData\Consultation;
use App\Models\MasterData\Specialist;
use App\Models\MasterData\ConfigPayment;

// thirdparty package

class ReportTransactionController extends Controller
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
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_user_condition = Auth::user()->detail_user->type_user_id;

        if($type_user_condition == 1){
            // for admin
            $transaction = Transaction::orderBy('created_at', 'desc')->get();
        }else{
            // other admin for doctor & patient ( task for everyone here )
            $transaction = Transaction::orderBy('created_at', 'desc')->get();
        }

        return view('pages.backsite.operational.transaction.index', compact('transaction'));
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
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('pages.backsite.operational.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        
        return view('pages.backsite.operational.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->all();
        $appointment = Appointment::orderBy('created_at', 'desc')->get();

        // upload process here
        $path = public_path('app/public/assets/file-bukti');
        if(!File::isDirectory($path)){
            $response = Storage::makeDirectory('public/assets/file-bukti');
        }

        // change file locations
        if(isset($data['bukti'])){
            $data['bukti'] = $request->file('bukti')->store(
                'assets/file-bukti', 'public'
            );
        }else{
            $data['bukti'] = "";
        }
        

        // update to database
        $transaction->update($data);

        // Retrieve and update the related appointment
    if ($transaction->appointment) {
        $transaction->appointment->status = 1; // set to completed payment
        $transaction->appointment->save();
    }
    
        alert()->success('Success Message', 'Successfully updated Transaction');
        return redirect()->route('backsite.transaction.index');

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

    //custom function
    public function cetak(){
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type_user_condition = Auth::user()->detail_user->type_user_id;

        if($type_user_condition == 1){
            // for admin
            $transaction = Transaction::orderBy('created_at', 'desc')->get();
        }else{
            // other admin for doctor & patient ( task for everyone here )
            $transaction = Transaction::orderBy('created_at', 'desc')->get();
        }

        return view('pages.backsite.operational.transaction.cetak', compact('transaction'));
    }

    public function cetaktransaction($id){
        
        $transaction = Transaction::where('id', $id)->first();
        $appointment = Appointment::orderBy('created_at', 'desc')->get();   

        return view('pages.backsite.operational.transaction.cetaktransaction', compact('transaction', 'appointment'));
    }
}
