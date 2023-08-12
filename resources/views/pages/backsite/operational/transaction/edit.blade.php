@extends('layouts.app')

{{-- set title --}}
@section('title', 'Transaction')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Transaction</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.transaction.index') }}">Transaction</a></li>
                                <li class="breadcrumb-item active">Upload Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="add-home">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <a data-action="collapse">
                                        <h4 class="card-title text-white">Upload Invoice</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <form class="form form-horizontal"
                                            action="{{ route('backsite.transaction.update', [$transaction->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @method('PUT')
                                            @csrf

                                            <div class="form-body">
                                                <div class="form-section">
                                                    <p>Lengkapi input yang<code>diperlukan</code>, sebelum Anda mengklik
                                                        tombol kirim.</p>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="total">Doctor</label>
                                                    <div class="col-md-9 mx-auto">
                                                    <label class="col-md-3 label-control text-left" for="total">{{ old('name', isset($transaction) ?  $transaction->appointment->doctor->name : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="total">Patient</label>
                                                    <div class="col-md-9 mx-auto">
                                                    <label class="col-md-3 label-control text-left" for="total">{{ old('name', isset($transaction) ?  $transaction->appointment->user->name : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="fee_doctor">Fee Doctor</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('fee_doctor', isset($transaction) ? number_format($transaction->fee_doctor) : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="fee_specialist">Fee Spesialist</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('fee_specialist', isset($transaction) ? number_format($transaction->fee_specialist) : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="fee_hospital">Fee Hospital</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('vat', isset($transaction) ? number_format($transaction->fee_hospital) : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="fee_hospital">Sub Total</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('vat', isset($transaction) ? number_format($transaction->sub_total) : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row ">
                                                    <label class="col-md-3 label-control" for="vat">Vat</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('vat', isset($transaction) ? number_format($transaction->vat) : '') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="total">Total</label>
                                                    <div class="col-md-9 mx-auto">
                                                        <label class="col-md-3 label-control text-left" for="total">: Rp. {{ old('total', isset($transaction) ? number_format($transaction->total) : '') }}</label>
                                                   </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="bukti">Invoice<code
                                                            style="color:red;">diperlukan</code></label>
                                                    <div class="col-md-9 mx-auto">
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/png, image/svg, image/jpeg"
                                                                class="custom-file-input" id="bukti" name="bukti"required>
                                                            <label class="custom-file-label" for="bukti"
                                                                aria-describedby="bukti">Choose File</label>
                                                        </div>

                                                        <p class="text-muted"><small class="text-danger">Hanya dapat
                                                                mengunggah 1 file</small><small> dan yang dapat digunakan
                                                                JPEG, SVG, PNG & Maksimal ukuran file hanya 10
                                                                MegaBytes</small></p>

                                                        @if ($errors->has('bukti'))
                                                            <p style="font-style: bold; color: red;">
                                                                {{ $errors->first('bukti') }}</p>
                                                        @endif

                                                    </div>
                                                </div>


                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.transaction.index') }}" style="width:120px;"
                                                    class="btn bg-blue-grey text-white mr-1"
                                                    onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                        onclick="return confirm('Are you sure want to save this data ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
        <!-- END: Content-->
    @endsection
