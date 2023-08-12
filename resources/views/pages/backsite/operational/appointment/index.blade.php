@extends('layouts.app')

{{-- set title --}}
@section('title', 'Appointment')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Appointment</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Appointment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- table card --}}
            @can('appointment_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Appointment List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        @can('appointment_export')
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                    <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                                </ul>
                                            </div>
                                        @endcan
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            @can('appointment_export')

                                                <form action="{{ route('backsite.appointment.index') }}" method="get" >
                                                    <div class="form-group">
                                                        <label for="doctor_filter">Filter by Doctor:</label>
                                                        <select name="doctor_filter" id="doctor_filter" class="form-control" style="width: 50%">
                                                            <option value="">All Doctors</option>
                                                            @foreach ($doctor as $doctor)
                                                                <option value="{{ $doctor->id }}"
                                                                    {{ request('doctor_filter') == $doctor->id ? 'selected' : '' }}>
                                                                    {{ $doctor->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                    <a href="{{ route('backsite.appointment.cetakfilterdokter', ['doctor_filter' => request('doctor_filter')]) }}"
                                                        class="btn btn-secondary" target="_blank" onclick="showMessage()">Cetak
                                                        Hasil Filter Doctor</a>
                                                </form>

                                                <div class="btn-group" style="margin-top: -63px; margin-left:31%">
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Show
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('backsite.appointment.index') }}">All</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('backsite.appointment.index', ['type' => 'UMUM']) }}">UMUM</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('backsite.appointment.index', ['type' => 'BPJS']) }}">BPJS</a>
                                                    </div>
                                                </div>

                                                <div class="btn-group" style="margin-top: -63px;">
                                                    <button type="button" class="btn btn-outline-success  dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Cetak
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('backsite.appointment.cetak') }}"
                                                            target="_blank">All</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('backsite.appointment.cetakUmum') }}"
                                                            target="_blank">UMUM</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('backsite.appointment.cetakBpjs') }}"
                                                            target="_blank">BPJS</a>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered text-inputs-searching default-table">
                                            <thead>
                                                <tr>
                                                    <th>recorded</th>
                                                    <th>Doctor</th>
                                                    <th>Patient</th>
                                                    <th>Complaint</th>
                                                    {{--  <th>Consultation</th>  --}}
                                                    <th>Level</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    @can('doctor_edit')
                                                        <th>Action</th>
                                                    @endcan
                                                </tr>
                                            </thead>

                                            @forelse($appointment as $key => $appointment_item)
                                                <tr data-entry-id="{{ $appointment_item->id }}">
                                                    <td>{{ isset($appointment_item->created_at) ? date('d/m/Y H:i:s', strtotime($appointment_item->created_at)) : '' }}
                                                    </td>
                                                    <td>{{ $appointment_item->doctor->name ?? '' }}</td>
                                                    <td>{{ $appointment_item->user->name ?? '' }}</td>
                                                    <td>

                                                        <span class="truncated-complaint">
                                                            {{ Str::limit($appointment_item->complaint, 50) }}
                                                        </span>

                                                        @if (strlen($appointment_item->complaint) > 50)
                                                            <button class="btn btn-link show-btn" data-toggle="modal"
                                                                data-target="#complaintModal_{{ $key }}">
                                                                Selengkapnya
                                                            </button>


                                                            <div class="modal fade" id="complaintModal_{{ $key }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="complaintModalLabel_{{ $key }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="complaintModalLabel_{{ $key }}">
                                                                                Complaint</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{ $appointment_item->complaint }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </td>

                                                    <td>
                                                        @if ($appointment_item->level == 1)
                                                            <span class="badge badge-primary">{{ 'Umum' }}</span>
                                                        @elseif($appointment_item->level == 2)
                                                            <span class="badge badge-success">{{ 'BPJS' }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ isset($appointment_item->date) ? date('Y-m-d', strtotime($appointment_item->date)) : '' }}
                                                    </td>
                                                    <td>{{ isset($appointment_item->time) ? date('H:i:s', strtotime($appointment_item->time)) : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($appointment_item->status == 1)
                                                            <span class="badge badge-success">{{ 'Sudah Bayar' }}</span>
                                                        @elseif($appointment_item->status == 2)
                                                            <span class="badge badge-danger">{{ 'Belum Bayar' }}</span>
                                                        @else
                                                            <span>{{ 'N/A' }}</span>
                                                        @endif
                                                    </td>
                                                    @can('doctor_edit')
                                                        <td>
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">Action</button>
                                                                <div class="dropdown-menu">

                                                                    {{--  <a href="#mymodal_{{ $key }}" 
                                                                                data-remote="{{ route('backsite.appointment.show', $appointment_item->id) }}"
                                                                                data-toggle="modal" data-target="#mymodal_{{ $key }}" 
                                                                                data-title="Appointment Detail" class="dropdown-item">
                                                                                    Detail
                                                                                </a>  --}}

                                                                    {{--  @can('doctor_delete')
                                                                                <form action="{{ route('backsite.doctor.destroy', $appointment_item->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item" value="Delete">
                                                                                </form>
                                                                            @endcan  --}}

                                                                    @can('doctor_show')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('backsite.appointment.cetakappointment', $appointment_item->id) }}"
                                                                            target="_blank">
                                                                            Cetak
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>


                                                        </td>
                                                    @endcan
                                                </tr>
                                            @empty
                                                {{-- not found --}}
                                            @endforelse


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

    </div>
    </div>
    <!-- END: Content-->

@endsection





@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}" />

    <style>
        .label {
            cursor: pointer;
        }

        .img-container img {
            max-width: 100%;
        }
    </style>
@endpush

@push('after-script')
    {{-- inputmask --}}
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/inputmask.js') }}"></script>
    <script src="{{ asset('/assets/backsite/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>

    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript">
    </script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });

        $(document).ready(function() {

            // Handle "Show" button click to display the full complaint content
            $('.show-btn').on('click', function() {
                var targetModalId = $(this).data('target');
                $('#' + targetModalId).modal('show');
            });

        });

        // alert cetak filter 

        function showMessage() {
            alert(
                "Pastikan sudah menekan tombol 'filter' sebelum mencetak hasil dokter agar tidak terjadi kesalahan pada saat pengambilan data dari dokter yang diinginkan"
                );
        }


        $(function() {
            $(":input").inputmask();
        });

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });
    </script>


    {{--  <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>  --}}
@endpush
