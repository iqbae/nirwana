@extends('layouts.app')

{{-- set title --}}
@section('title', 'My Appointment')

@section('content')

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
                <h3 class="content-header-title mb-0 d-inline-block">My Appointment</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">My Appointment</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @can('appointment_table')
            <div class="content-body">
                <section id="table-home">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Appointment List</h4>
                                    <!-- Action Buttons -->
                                </div>
{{--  {{ route('backsite.my-appointment.index') }}  --}}
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form action="" method="get">
                                            <!-- Filter Form -->
                                        </form>
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
                                                <th>Level</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        @forelse($appointments as $appointment)
                                            <tr data-entry-id="{{ $appointment->id }}">
                                                <!-- Appointment Data -->
                                                <td>{{ date('d/m/Y H:i:s', strtotime($appointment->created_at)) }}</td>
                                                <td>{{ $appointment->doctor->name ?? '' }}</td>
                                                <td>{{ $appointment->user->name ?? '' }}</td>
                                                <td>
                                                    <span class="truncated-complaint">
                                                        {{ Str::limit($appointment->complaint, 50) }}
                                                    </span>
                                                    @if (strlen($appointment->complaint) > 50)
                                                        <!-- Show More Button and Modal -->
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($appointment->level == 1)
                                                        <span class="badge badge-primary">{{ 'Umum' }}</span>
                                                    @elseif($appointment->level == 2)
                                                        <span class="badge badge-success">{{ 'BPJS' }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('Y-m-d', strtotime($appointment->date)) }}</td>
                                                <td>{{ date('H:i:s', strtotime($appointment->time)) }}</td>
                                                <td>
                                                    @if ($appointment->status == 1)
                                                        <span class="badge badge-success">{{ 'Sudah Bayar' }}</span>
                                                    @elseif($appointment->status == 2)
                                                        <span class="badge badge-danger">{{ 'Belum Bayar' }}</span>
                                                    @else
                                                        <span>{{ 'N/A' }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <!-- Dropdown Actions -->
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <!-- No Appointments -->
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endcan

    </div>
</div>

@endsection