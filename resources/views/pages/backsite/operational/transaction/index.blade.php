@extends('layouts.app')

{{-- set title --}}
@section('title', 'Transaction')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Transaction</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- table card --}}
            @can('transaction_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Transaction List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            @can('doctor_edit')
                                                <div class="mb-2">

                                                    <a href="{{ route('backsite.transaction.index') }}"
                                                        class="btn btn-secondary">Show All</a>
                                                    <a href="{{ route('backsite.transaction.index', ['status' => 'Sudah Bayar']) }}"
                                                        class="btn btn-success">Show Sudah Bayar</a>
                                                    <a href="{{ route('backsite.transaction.index', ['status' => 'Belum Bayar']) }}"
                                                        class="btn btn-warning">Show Belum Bayar</a>
                                                    <div class="btn" style="width: 50%"></div>
                                                    <a href="{{ route('backsite.transaction.cetak') }}"
                                                        target="_blank"class="btn btn-outline-secondary">Cetak All</a>
                                                </div>
                                            @endcan

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>recorded</th>
                                                            <th>Doctor</th>
                                                            <th>Patient</th>
                                                            <th>Fee Doctor</th>
                                                            <th>Fee Specialist</th>
                                                            <th>Fee Hospital</th>
                                                            <th>Sub total</th>
                                                            <th>Vat</th>
                                                            <th>Total</th>
                                                            <th>Status Bayar</th>
                                                            <th>Invoice</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($transaction as $key => $transaction_item)
                                                            <tr data-entry-id="{{ $transaction_item->id }}">
                                                                <td>{{ isset($transaction_item->created_at) ? date('d/m/Y H:i:s', strtotime($transaction_item->created_at)) : '' }}
                                                                </td>
                                                                <td>{{ $transaction_item->appointment->doctor->name ?? '' }}
                                                                </td>
                                                                <td>{{ $transaction_item->appointment->user->name ?? '' }}</td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->fee_doctor) ?? '' }}
                                                                </td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->fee_specialist) ?? '' }}
                                                                </td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->fee_hospital) ?? '' }}
                                                                </td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->sub_total) ?? '' }}
                                                                </td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->vat) ?? '' }}
                                                                </td>
                                                                <td>{{ 'Rp. ' . number_format($transaction_item->total) ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if ($transaction_item->appointment->status == 1)
                                                                        <span class="text-success">{{ 'Sudah Bayar' }}</span>
                                                                    @elseif($transaction_item->appointment->status == 2)
                                                                        <span class="text-warning">{{ 'Belum Bayar' }}</span>
                                                                    @else
                                                                        <span>{{ 'N/A' }}</span>
                                                                    @endif
                                                                </td>
                                                                <td><a data-fancybox="gallery"
                                                                        data-src="{{ request()->getSchemeAndHttpHost() . '/storage' . '/' . $transaction_item->bukti }}"
                                                                        class="blue accent-4">Show</a></td>

                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('backsite.transaction.cetaktransaction', $transaction_item->id) }}"
                                                                                target="_blank">
                                                                                Cetak Invoice
                                                                            </a>

                                                                            <a href="#mymodal"
                                                                                data-remote="{{ route('backsite.transaction.show', $transaction_item->id) }}"
                                                                                data-toggle="modal" data-target="#mymodal"
                                                                                data-title="Detail" class="dropdown-item">
                                                                                Show Detail
                                                                            </a>
                                                                            {{--  <form action="{{ route('backsite.doctor.destroy', $doctor_item->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item" value="Delete">
                                                                                </form>  --}}
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('backsite.transaction.edit', $transaction_item->id) }}">
                                                                                Upload Invoice
                                                                            </a>



                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>

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

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css') }}">

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

        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 10

        });

        $(function() {
            $(":input").inputmask();
        });

        // fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false
        });
    </script>

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
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
    </div>
@endpush
