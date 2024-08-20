@extends('layouts.default')

@section('title', 'Payment')

@section('content')



    <!-- Content -->
    
        

    <div class="min-h-screen">
        <div class="max-w-7xl grid lg:grid-cols-12 mx-auto pt-14 lg:pt-20 pb-20 lg:pb-28 lg:divide-x px-4 lg:px-16">

            <!-- Detail Payment -->

            <div  class="print-area lg:col-span-7 lg:pl-8 lg:pr-20">
                <!-- Doctor Information -->
                <div class="flex flex-wrap items-center space-x-5">
                    <div class="flex-shrink-0">
                        <img src="{{ url(Storage::url($appointment->doctor->photo)) ?? '' }}"
                            class="w-20 h-20 rounded-full bg-center object-cover object-top" alt="Doctor 1" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <div class="text-[#1E2B4F] text-lg font-semibold">
                            {{ $appointment->doctor->name ?? '' }}
                        </div>
                        <div class="text-[#AFAEC3]">{{ $appointment->doctor->specialist->name ?? '' }}</div>

                        <!--
                            Icon when mobile is show.
                            star icon mobile: "flex/show", star icon dekstop: "hidden"
                            -->
                        <div class="lg:hidden flex items-center gap-x-2">
                            <div class="flex items-center gap-2">
                                
                            </div>
                            
                        </div>
                    </div>

                    <!--Icon when desktop is show. star icon mobile: "hidden", star icon dekstop: "flex/show"-->
                    <div class="hidden lg:flex items-center gap-x-2">
                        <div class="flex items-center gap-2">
                            
                        </div>
                        
                    </div>
                </div>

                <!-- Appoinment Information -->
                <div class="mt-16">
                    <h5 class="text-[#1E2B4F] text-lg font-semibold">Appointment</h5>
                    {{--  <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Kebutuhan konsultasi</div>
                        <div class="text-[#1E2B4F] font-medium">{{ $appointment->consultation->name ?? '' }}</div>
                    </div>  --}}

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Layanan</div>
                        <div class="text-[#1E2B4F] font-medium">
                            @if ($appointment->level == 1)
                                {{ 'Umum' }}
                            @elseif ($appointment->level == 2)
                                {{ 'BPJS' }}
                            @else
                                {{ 'N/A' }}
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Dijadwalkan pada</div>
                        <div class="text-[#1E2B4F] font-medium">{{ date('d F Y', strtotime($appointment->date)) ?? '' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Waktu</div>
                        <div class="text-[#1E2B4F] font-medium">{{ date('H:i', strtotime($appointment->time)) ?? '' }}</div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Antrian</div>
                        <div class="text-[#1E2B4F] font-medium">{{ ($appointment->queue_number) ?? '' }}</div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Status</div>
                        <div class="text-[#1E2B4F] font-medium">
                            @if ($appointment->status == 1)
                                {{ 'Pembayaran selesai' }}
                            @elseif ($appointment->status == 2)
                                {{ 'Menunggu Pembayaran' }}
                            @else
                                {{ 'N/A' }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="mt-16">
                    <h5 class="text-[#1E2B4F] text-lg font-semibold">
                        Informasi Pembayaran
                    </h5>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Biaya konsultasi</div>
                        <div class="text-[#1E2B4F] font-medium">
                            {{ 'Rp. ' . number_format($appointment->doctor->specialist->price) ?? '' }}</div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Jasa Dokter</div>
                        <div class="text-[#1E2B4F] font-medium">
                            {{ 'Rp. ' . number_format($appointment->doctor->fee) ?? '' }}</div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Jasa Rumah sakit</div>
                        <div class="text-[#1E2B4F] font-medium">{{ 'Rp. ' . number_format($config_payment->fee) ?? '' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">PPN {{ $config_payment->vat ?? '' }}%</div>
                        <div class="text-[#1E2B4F] font-medium">{{ 'Rp. ' . number_format($total_with_vat) ?? '' }}</div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <div class="text-[#AFAEC3] font-medium">Total</div>
                        <div class="text-[#2AB49B] font-semibold">{{ 'Rp. ' . number_format($grand_total) ?? '' }}</div>
                    </div>
                </div>
            </div>
            

            <!-- Choose Payment -->
            <div class="lg:col-span-5 lg:pl-20 lg:pr-7 mt-10 lg:mt-0">
                <h2 class="text-[#1E2B4F] text-3xl font-semibold leading-normal">
                    <br> Ajukan <br />
                    Penunjukan Baru
                </h2>

                <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data"
                    x-data="{ payment: '' }" class="mt-8">

                    @csrf

                    <!-- List Payment -->
                    <p class="text-[#AFAEC3] text-sm mt-2">
                        Pastikan kembali semua data telah benar. Silahkan simpan terlebih dahulu sebagai bukti anda melakukan janji dengan dokter.
                    </p>
                    
                    <div class="mt-10 grid">
                        <input type="hidden" name="appointment_id" value="{{ $id ?? '' }}">
                            <button type="submit" class="bg-[#0EFB71] text-white px-10 py-3 rounded-full text-center"
                            onclick="return confirm('Pastikan melakukan pembayaran kekasir setibanya dirumah sakit')">Lanjutkan</button>
                    </div>
                </form>
                {{--  <div class="mt-10 grid">
                input type
                        <button type="submit" class="bg-[#C0CADA] text-white px-10 py-3 rounded-full text-center"
                        onclick="return confirm('Pastikan melakukan pembayaran kekasir setibanya dirumah sakit')">Cetak</button>
            </div>  --}}
            {{--  <form action="/" method="get" enctype="multipart/form-data"  --}}
            

            <div class="mt-10 grid">
                <a href="{{ route('payment.receipt', $appointment->id) }}" class="bg-[#C0CADA] text-white px-10 py-3 rounded-full text-center">Cetak Struk</a>

                {{--  <button class="bg-[#C0CADA] text-white px-10 py-3 rounded-full text-center" id="printBtn">Simpan</button>  --}}

               {{-- <button type="submit" class="bg-[#C0CADA] text-white px-10 py-3 rounded-full text-center"
                        onclick="return confirm('Pastikan melakukan pembayaran kekasir setibanya dirumah sakit')">Cetak</button>
                  <a href="{{ route('payment.bukti') }}" class="inline-block mt-10 bg-[#0EFB71] text-white rounded-full px-14 py-3">My Dashboard</a>  --}}
            </div>
        </form>

        </div>
    </div>
    

<script type="text/javascript">

    document.getElementById('printBtn').addEventListener('click', () => { window.print() });
    // Prints area to which class was assigned only
  
  </script>
@endsection
