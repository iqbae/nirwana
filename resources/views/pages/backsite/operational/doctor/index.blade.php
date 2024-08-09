@extends('layouts.app')

{{-- set title --}}
@section('title', 'Doctor')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Doctor</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Doctor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('doctor_create')
                <div class="content-body">
                    <section id="add-home">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Tambah Dokter</h4>
                                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card-content collapse hide">
                                        <div class="card-body card-dashboard">

                                            <form class="form form-horizontal" action="{{ route('backsite.doctor.store') }}" method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Lengkapi input yang<code>diperlukan</code>, sebelum Anda mengklik tombol kirim.</p>
                                                    </div>

                                                    <div class="form-group row {{ $errors->has('specialist_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Specialist <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="specialist_id"
                                                                    id="specialist_id"
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                @foreach($specialist as $key => $specialist_item)
                                                                    <option value="{{ $specialist_item->id }}">{{ $specialist_item->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @if($errors->has('specialist_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('specialist_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="name">Name <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="example john doe or jane doe" value="{{old('name')}}" autocomplete="off" required>

                                                            @if($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="fee">Fee <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="fee" name="fee" class="form-control" placeholder="example fee 10000" value="{{old('fee')}}" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'Rp. ', 'placeholder': '0'" required>

                                                            @if($errors->has('fee'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('fee') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="photo">Photo <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <div class="custom-file">
                                                                <input type="file" accept="image/png, image/svg, image/jpeg" class="custom-file-input" id="photo" name="photo" required>
                                                                <label class="custom-file-label" for="photo" aria-describedby="photo">Choose File</label>
                                                            </div>

                                                            <p class="text-muted"><small class="text-danger">Hanya dapat mengunggah 1 file</small><small> dan yang dapat digunakan JPEG, SVG, PNG & Maksimal ukuran file hanya 10 MegaBytes</small></p>

                                                            @if($errors->has('photo'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('photo') }}</p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    {{--  start jadwal & col  --}}
                                                    <div class="card-header">
                                                        <h4 class="card-title" id="horz-layout-basic">Jadwal Praktik</h4>
                                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                                        </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="monday">Senin <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="monday" name="monday" class="form-control" placeholder="example john doe or jane doe" value="{{old('monday')}}" autocomplete="off" >

                                                                    @if($errors->has('monday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('monday') }}</p>
                                                                    @endif
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="tuesday">selasa <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="tuesday" name="tuesday" class="form-control" placeholder="example john doe or jane doe" value="{{old('tuesday')}}" autocomplete="off" >

                                                                    @if($errors->has('tuesday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('tuesday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="wednesday">rabu <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="wednesday" name="wednesday" class="form-control" placeholder="example john doe or jane doe" value="{{old('wednesday')}}" autocomplete="off" >

                                                                    @if($errors->has('wednesday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('wednesday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="thursday">kamis <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="thursday" name="thursday" class="form-control" placeholder="example john doe or jane doe" value="{{old('thursday')}}" autocomplete="off" >

                                                                    @if($errors->has('thursday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('thursday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="friday">jumat <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="friday" name="friday" class="form-control" placeholder="example john doe or jane doe" value="{{old('friday')}}" autocomplete="off" >

                                                                    @if($errors->has('friday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('friday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="saturday">sabtu <code style="color:green;">optional</code></label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <input type="time" id="saturday" name="saturday" class="form-control" placeholder="example john doe or jane doe" value="{{old('saturday')}}" autocomplete="off" >

                                                                    @if($errors->has('saturday'))
                                                                        <p style="font-style: bold; color: red;">{{ $errors->first('saturday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                    
                                                    {{--  end col  --}}
                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan" onclick="return confirm('Are you sure want to save this data ?')">
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
            @endcan

            {{-- table card --}}
            @can('doctor_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Daftar Specialis</h4>

                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a href="{{ route('backsite.doctor.cetak') }}" target="_blank" class="btn btn-outline-secondary">Cetak</a></li>
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
                                                            <th>recorded</th>
                                                            <th>Specialist</th>
                                                            <th>Name</th>
                                                            <th>Fee</th>
                                                            <th>Photo</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($doctor as $key => $doctor_item)
                                                            <tr data-entry-id="{{ $doctor_item->id }}">
                                                                <td>{{ isset($doctor_item->created_at) ? date("d/m/Y H:i:s",strtotime($doctor_item->created_at)) : '' }}</td>
                                                                <td>{{ $doctor_item->specialist->name ?? '' }}</td>
                                                                <td>{{ $doctor_item->name ?? '' }}</td>
                                                                <td>{{ 'Rp. '.number_format($doctor_item->fee) ?? '' }}</td>
                                                                <td><a data-fancybox="gallery" data-src="{{ request()->getSchemeAndHttpHost().'/storage'.'/'.$doctor_item->photo }}" class="blue accent-4">Show</a></td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">

                                                                            @can('doctor_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.doctor.show', $doctor_item->id) }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#mymodal"
                                                                                    data-title="Doctor Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan

                                                                            @can('doctor_edit')
                                                                                <a class="dropdown-item" href="{{ route('backsite.doctor.edit', $doctor_item->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan

                                                                            @can('doctor_delete')
                                                                                <form action="{{ route('backsite.doctor.destroy', $doctor_item->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item" value="Delete">
                                                                                </form>
                                                                            @endcan

                                                                            @can('doctor_show')
                                                                                <a class="dropdown-item" href="{{ route('backsite.doctor.cetakdokter', $doctor_item->id) }}" target="_blank" >
                                                                                    Cetak
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                    {{--  <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Specialist</th>
                                                            <th>Name</th>
                                                            <th>Fee</th>
                                                            <th>Photo</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>  --}}
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



            {{-- table card --}}
            @can('doctor_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header  text-white bg-warning bg-lighten-1">
                                        <h4 class="card-title text-white">Jadwal Praktik Dokter</h4>

                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a href="{{ route('backsite.doctor.cetakjadwal') }}" target="_blank" class="btn btn-outline-light">Cetak</a></li>
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
                                                            <th>Nama</th>
                                                            <th>Senin</th>
                                                            <th>Selasa</th>
                                                            <th>Rabu</th>
                                                            <th>Kamis</th>
                                                            <th>Jumat</th>
                                                            <th>Sabtu</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($doctor as $key => $doctor_item)
                                                            <tr data-entry-id="{{ $doctor_item->id }}">
                                                               <td>{{ $doctor_item->name ?? '' }}</td>
                                                                <td>{{ $doctor_item->monday ?? '' }}</td>
                                                                <td>{{ $doctor_item->tuesday ?? '' }}</td>
                                                                <td>{{ $doctor_item->wednesday ?? '' }}</td>
                                                                <td>{{ $doctor_item->thursday ?? '' }}</td>
                                                                <td>{{ $doctor_item->friday ?? '' }}</td>
                                                                <td>{{ $doctor_item->saturday ?? '' }}</td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                    {{--  <tfoot>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Senin</th>
                                                            <th>Selasa</th>
                                                            <th>Rabu</th>
                                                            <th>Kamis</th>
                                                            <th>Jumat</th>
                                                            <th>Sabtu</th>
                                                        </tr>
                                                    </tfoot>  --}}
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

    <script src="{{ url('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js') }}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function($){
            $('#mymodal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });

            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2-full-bg')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });

        $('.default-table').DataTable( {
            "order": [],
            "paging": true,
            "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
            "pageLength": 5
            
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
