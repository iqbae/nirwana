@extends('layouts.default')

@section('title', 'Home')

@section('content')

    <!-- Content -->
    <main class="min-h-screen">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <!-- Hero -->
        <section class="relative mt-12">
            <!-- Hero Image -->
            <div class="lg:block lg:absolute lg:z-20 lg:top-0 lg:right-0"
            aria-hidden="true">
                <img src="{{ asset('/assets/frontsite/images/gedung.png') }}" class="bg-cover bg-center object-cover object-center max-h-[580px]" alt="Hero Image"/>
            </div>

            <!-- Hero Description -->
            <div class="relative mx-auto max-w-7xl px-4 lg:px-14 lg:py-14">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="lg:col-span-6">

                        <!-- Label New -->
                        <h1>
                            <div class="flex items-center">
                                <span class="text-white text-xs sm:text-sm font-medium bg-[#2AB49B] rounded-full px-8 py-2">Soon</span>
                                <span class="text-[#1E2B4F] text-[11px] sm:text-sm bg-[#F2F6FE] rounded-r-full px-8 py-2 relative -z-10 -ml-4">Fitur pembayaran sedang dikembangkan</span>
                            </div>

                            <span class="mt-6 block text-4xl font-semibold sm:text-5xl">
                                <span class="block text-[#1E2B4F] leading-normal">Bersama kami. <br />Terpercaya & Profesional.</span>
                            </span>
                        </h1>
                        <!-- End Label New -->

                        <!-- Text -->
                        <div class="flex flex-wrap gap-16 mt-8">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('/assets/frontsite/images/service.svg') }}" alt="service icon"/>
                                </div>
                                <div>
                                    <h5 class="text-[#1E2B4F] text-lg font-medium">Resep Terbaik</h5>
                                    <p class="text-[#AFAEC3]">untuk pengobatan Anda</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('/assets/frontsite/images/service.svg') }}" alt="service icon"/>
                                </div>
                                <div>
                                    <h5 class="text-[#1E2B4F] text-lg font-medium">Fasilitas Terbaik</h5>
                                    <p class="text-[#AFAEC3]">seperti yang dijanjikan</p>
                                </div>
                            </div>
                        </div>
                        <!-- Text -->

                        <!-- CTA Button -->
                        <div class="grid lg:flex flex-wrap mt-10 gap-5">
                            <a href="{{ route('register') }}" class="text-white text-lg font-medium text-center bg-[#0EFB71] rounded-full px-12 py-3">Daftar</a>
                            {{--  <a href="#" class="text-[#1E2B4F] text-lg font-medium text-center bg-[#F2F6FE] rounded-full px-16 py-3">Story</a>  --}}
                        </div>
                        <!-- CTA Button -->

                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <!-- Popular Categories -->
        <section class="mt-10 bg-[#F9FBFC]">
            <div class="mx-auto max-w-7xl px-4 lg:px-14 py-0">
                <h3 class="text-2xl font-semibold">Spesialis Kami</h3>
                <p class="text-[#A7B0B5] mt-2">Pilihan spesialis yang tersedia untuk anda</p>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 sm:gap-8 md:gap-10 lg:gap-12 mt-10">
                    @forelse($specialist as $key => $specialist_item)
                        <!-- Card -->
                            <a  class="bg-white py-6 px-5 rounded-2xl transition hover:ring-offset-2 hover:ring-2 hover:ring-[#0EFB71]">
                                <h5 class="text-[#1E2B4F] text-lg font-semibold">{{ $specialist_item->name ?? '' }}</h5>
                                {{--  <p class="text-[#AFAEC3] mt-1">143 doctors</p>  --}}
                            </a>
                        <!-- End Card -->
                    @empty
                    {{-- empty --}}
                    @endforelse
                </div>

            </div>
        </section>
        <!-- End Popular Categories -->

        <!-- Best Doctors -->
        <section class="mt-4 lg:mt-10">
            <div class="mx-auto max-w-7xl px-4 lg:px-14 py-14">
                <h3 class="text-[#1E2B4F] text-2xl font-semibold">Dokter Kami</h3>
                <p class="text-[#A7B0B5] mt-2">Membantu hidup Anda menjadi lebih baik</p>

                <!-- Card -->
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12 lg:gap-10 mt-10">

                    @forelse($doctor as $key => $doctor_item)

                        <a href="{{ route('appointment.doctor', $doctor_item->id) }}" class="group">
                            <div class="relative z-10 w-full h-[350px] rounded-2xl overflow-hidden">
                                <img src="{{ url(Storage::url($doctor_item->photo)) }}" class="w-full h-full bg-center bg-no-repeat object-cover object-center" alt="{{ $doctor_item->name ?? '' }}">
                                <div class="opacity-0 group-hover:opacity-100 transition-all ease-in absolute inset-0 bg-[#0EFB71] bg-opacity-70 flex justify-center items-center">
                                    <span class="text-[#0EFB71] font-medium bg-white rounded-full px-8 py-3">Book Now</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-5">
                                <div>
                                    <div class="text-[#1E2B4F] text-lg font-semibold">{{ $doctor_item->name ?? '' }}</div>
                                    <div class="text-[#AFAEC3] mt-1">{{ $doctor_item->specialist->name ?? '' }}</div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('/assets/frontsite/images/star.svg') }}" alt="Star">
                                    <span class="block text-[#1E2B4F] font-medium">4.5</span>
                                </div>
                            </div>
                        </a>

                    @empty

                        {{-- empty --}}

                    @endforelse

                </div>
                <!-- End Card -->
            </div>
        </section>
        <!-- End Best Doctors -->

    </main>
    <!-- End Content -->

@endsection
