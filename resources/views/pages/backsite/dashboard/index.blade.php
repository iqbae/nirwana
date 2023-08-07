@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        {{-- show error --}}
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
                <h3 class="content-header-title mb-0 d-inline-block">Dashboard</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Activity</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

      
        <div class="row mb-3">
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Dokter</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                   </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Earnings (Annual) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pasien</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                    </div>
                  <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- New User Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Transaksi selesai</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                    </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
         </div>

          

    </div>
</div>
<!-- END: Content-->

@endsection
