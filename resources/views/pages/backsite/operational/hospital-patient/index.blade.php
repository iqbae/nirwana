@extends('layouts.app')

{{-- set title --}}
@section('title', 'hospital_patient')

@section('content')

<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Hospital Patient</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Hospital Patient</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- table card --}}
            @can('hospital_patient_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Patient List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a href="hospital_patient/create" target="_blank" class="btn btn-outline-secondary">Export PDF</a></li>
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date Registered</th> 
                                                            {{--  <th>Doctor</th>  --}}
                                                            <th>Patient Name</th>
                                                            {{--  <th>Consultation</th>  --}}
                                                            {{--  <th>Level</th>  --}}
                                                            {{--  <th>Date</th>  --}}
                                                            {{--  <th>Time</th>  --}}
                                                            {{--  <th>Status</th>  --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($hospital_patient as $key => $patient_item)
                                                        <tr data-entry-id="{{ $patient_item->id }}">
                                                            <td>{{ isset($patient_item->created_at) ? date("d/m/Y H:i:s",strtotime($patient_item->created_at)) : '' }}</td>
                                                            {{--  <td>{{ $patient_item->doctor->name ?? '' }}</td>  --}}
                                                            <td>{{ $patient_item->name ?? '' }}</td>
                                                            {{--  <td>{{ $patient_item->consultation->name ?? '' }}</td>  --}}
                                                            
                                                                
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date Registered</th> 
                                                            {{--  <th>Doctor</th>  --}}
                                                            <th>Patient Name</th>
                                                            {{--  <th>Consultation</th>  --}}
                                                            {{--  <th>Level</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>  --}}
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan

        </div>
    </div>
<!-- END: Content-->

@endsection

@push('after-script')
    <script>
        $('.default-table').DataTable( {
            "order": [],
            "paging": true,
            "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
            "pageLength": 10
        });
    </script>
@endpush
