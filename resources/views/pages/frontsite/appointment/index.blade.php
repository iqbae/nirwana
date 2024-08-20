@extends('layouts.default')

@section('title', 'Appointment')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Content -->
    <div class="min-h-screen">
        <div class="lg:max-w-7xl lg:flex items-center mx-auto px-4 lg:px-14 pt-6 py-20 lg:py-24 gap-x-24">
            <!-- Detail Doctor  -->
            @if(isset($doctor) && $doctor)
    <div class="lg:w-5/12 lg:border-r h-72 lg:h-[30rem] flex flex-col items-center justify-center text-center">
        <img src="{{ url(Storage::url($doctor->photo)) }}" 
             class="inline-block w-32 h-32 rounded-full bg-center object-cover object-top" alt="doctor-1" />
        <div class="text-[#1E2B4F] text-lg font-semibold mt-4">
            {{ $doctor->name ?? '' }}
        </div>

        <div class="text-[#AFAEC3] mt-1">{{ $doctor->specialist->name ?? '' }}</div>

        <!-- Jadwal -->
        <div class="mt-6">
            <table class="text-[#1E2B4F] table-auto mt-2">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Hari</th>
                        <th class="px-4 py-2">Jam Praktek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Senin</td>
                        <td class="border px-4 py-2">{{ substr($doctor->monday, 0, 5) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Selasa</td>
                        <td class="border px-4 py-2">{{ substr($doctor->tuesday, 0, 5) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Rabu</td>
                        <td class="border px-4 py-2">{{ substr($doctor->wednesday, 0, 5) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Kamis</td>
                        <td class="border px-4 py-2">{{ substr($doctor->thursday, 0, 5) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jumat</td>
                        <td class="border px-4 py-2">{{ substr($doctor->friday, 0, 5) ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Sabtu</td>
                        <td class="border px-4 py-2">{{ substr($doctor->saturday, 0, 5) ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@else
    <p>Data dokter tidak tersedia atau terjadi kesalahan.</p>
@endif


            <!-- Form Appointment -->
            <div class="lg:w-1/3 mt-10 lg:mt-0">
                <h2 class="text-[#1E2B4F] text-3xl font-semibold leading-normal">
                    Apply for <br />
                    New Appointment
                </h2>

                <form action="{{ route('appointment.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-5">

                    @csrf

                    <label class="block">
                        <textarea
                            name="complaint"
                            id="complaint"
                            class="block w-full rounded-2xl py-4 text-[#1E2B4F] font-medium px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                            placeholder="Tuliskan Keluhan Anda disini" required
                            rows="4" 
                        ></textarea>
                    </label>

                    <p class="text-[#AFAEC3] text-justify text-sm mt-2">Apabila Anda bingung untuk menentukan dokter untuk Keluhan anda silahkan untuk memilih dokter umum sebagai langkah awal dalam menentukan diagnosa anda</p>
                    
                    <label class="block">
                        <select
                            name="level_id"
                            id="level_id"
                            class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0D63F3]"
                            placeholder="Layanan" required
                        >
                            <option value="" disabled selected class="hidden">Layanan</option>
                            <option value="1">Umum</option>
                            <option value="2">BPJS</option>
                        </select>
                    </label>

                    <label class="relative block">
                        <input
                            type="text"
                            id="date"
                            name="date"
                            class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0EFB71]"
                            placeholder="Pilih Hari" required
                        />
                        <span
                            class="absolute top-0 right-[11px] bottom-1/2 translate-y-[58%]"
                        ><svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z"
                            stroke="#AFAEC3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            />
                            <path
                            d="M3 10H21"
                            stroke="#AFAEC3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            />
                            <path
                            d="M16 2V6"
                            stroke="#AFAEC3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            />
                            <path
                            d="M8 2V6"
                            stroke="#AFAEC3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            />
                        </svg>
                    </span>
                    </label>
                   
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id ?? '' }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="grid">
                        <button type="submit" class="bg-[#0EFB71] rounded-full mt-5 text-white text-lg font-medium px-10 py-3 text-center" onclick="return confirm('Are you sure want to confirm this appointment ?')">Continue</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End Content -->

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}"/>
@endpush

@push('after-script')
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>

    <script>
        // Date Picker
        const fpDate = flatpickr('#date', {
            altInput: true,
            altFormat: 'd F Y',
            dateFormat: 'Y-m-d',
            disableMobile: 'true',
            minDate: new Date().fp_incr(1), // Set minDate to tomorrow
            maxDate: new Date().fp_incr(7), // 6 days from today
            disable: [
                function(date) {
                    // Disable Sundays
                    return (date.getDay() === 0);
                }
            ] 
        });
    </script>
@endpush
