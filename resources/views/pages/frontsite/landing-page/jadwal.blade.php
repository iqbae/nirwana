@extends('layouts.default')

@section('title', 'Jadwal')

@section('content')

    <!-- Content -->
    <main class="min-h-screen">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <body class="bg-gray-100">
            <div class="container mx-auto py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @forelse($doctor as $key => $doctor_item)
                        <a href="{{ route('appointment.doctor', $doctor_item->id) }}" class="group ">
                            <div class="col-span-1 md:col-span-1 flex flex-col items-center mb-8">
                                <img src="{{ url(Storage::url($doctor_item->photo)) }}" alt="Foto Dokter" class="inline-block bg-center w-32 h-32 object-cover rounded-full object-top mb-4">
                                <h1 class="text-xl text-[#1E2B4F] font-semibold">{{ $doctor_item->name ?? '' }}</h1>
                                <p class="text-gray-600">{{ $doctor_item->specialist->name ?? '' }}</p>
                                <button class="bg-[#0EFB71] hover:bg-green-400 text-white px-4 py-2 font-medium rounded-full mt-4">Book Now</button>  
                            </div>
                        </a>
                        <div class="col-span-1 md:col-span-3 overflow-x-auto">
                            <table class="w-full text-black mt-20 bg-[#ffffff] table-class">
                                <thead>
                                    <tr class="text-center">
                                        <th class="px-4 py-6"></th>
                                        <th class="px-4 py-6">Senin</th>
                                        <th class="px-4 py-6">Selasa</th>
                                        <th class="px-4 py-6">Rabu</th>
                                        <th class="px-4 py-6">Kamis</th>
                                        <th class="px-4 py-6">Jumat</th>
                                        <th class="px-4 py-6">Sabtu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="px-4 py-4 font-bold">Jam Praktik</td>
                                        <td class="px-4 py-4">{{ $doctor_item->monday == '00:00:00' ? 'Tutup' : substr($doctor_item->monday, 0, 5) }}</td>
                                        <td class="px-4 py-4">{{ $doctor_item->tuesday == '00:00:00' ? 'Tutup' : substr($doctor_item->tuesday, 0, 5) }}</td>
                                        <td class="px-4 py-4">{{ $doctor_item->wednesday == '00:00:00' ? 'Tutup' : substr($doctor_item->wednesday, 0, 5) }}</td>
                                        <td class="px-4 py-4">{{ $doctor_item->thursday == '00:00:00' ? 'Tutup' : substr($doctor_item->thursday, 0, 5) }}</td>
                                        <td class="px-4 py-4">{{ $doctor_item->friday == '00:00:00' ? 'Tutup' : substr($doctor_item->friday, 0, 5) }}</td>
                                        <td class="px-4 py-4">{{ $doctor_item->saturday == '00:00:00' ? 'Tutup' : substr($doctor_item->saturday, 0, 5) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @empty
                        {{-- empty --}}
                    @endforelse
                </div>
            </div>
        </body>
    </main>
    <!-- End Content -->
@endsection
