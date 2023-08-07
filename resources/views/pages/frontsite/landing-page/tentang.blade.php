@extends('layouts.default')

@section('title', 'Tentang Kami')

@section('content')


    <main class="container mx-auto py-8">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <div class="m-8 grid grid-cols-3 gap-4 justify-evenly text-[#1E2B4F] mb-10">
            <div class="">
                <img src="{{ asset('/assets/frontsite/images/gedung.png') }}" alt="" class="w-auto">

            </div>
            <div class="col-span-2">
                <h1 class="text-4xl font-semibold mb-4">Profil Rumah Sakit Nirwana</h1>
                <p class="mb-4 text-justify">
                    Selamat datang di Rumah Sakit Nirwana, sebuah fasilitas medis yang berkomitmen untuk menyediakan
                    pelayanan
                    kesehatan terbaik bagi masyarakat. Sebagai bagian dari visi kami untuk meningkatkan kualitas hidup
                    pasien, kami menyediakan layanan kesehatan yang berfokus pada pencegahan, perawatan, dan pemulihan
                    secara holistik.
                </p>
                <p class="mb-4 text-justify">
                    Rumah Sakit Nirwana didirikan dengan tujuan utama untuk memberikan perawatan kesehatan yang berkualitas,
                    terjangkau, dan inovatif bagi seluruh lapisan masyarakat. Kami berkomitmen untuk memahami kebutuhan unik
                    setiap pasien dan memberikan perawatan
                    yang penuh perhatian dan berdaya guna.
                </p>

                {{--  <p class="mb-4">
                    Kami mengundang Anda untuk mengunjungi Rumah Sakit Kami dan mengalami sendiri pelayanan kesehatan
                    terbaik yang kami tawarkan. Tim kami siap membantu Anda dengan segala pertanyaan dan kebutuhan yang Anda
                    miliki. Bersama-sama, mari jaga kesehatan kita dan wujudkan masa depan yang lebih sehat untuk kita
                    semua.
                </p>  --}}
            </div>
        </div>
        <div class="m-8 grid grid-cols-3 gap-4 justify-evenly text-[#1E2B4F]">
            <div class="">
                <h2 class="text-4xl font-semibold mb-4">Struktur Rumah Sakit Nirwana</h2>
                <p class="mb-4 text-justify">Berikut adalah gambaran struktur organisasi Rumah Sakit Kami, menampilkan
                    hubungan antara berbagai departemen
                    dan tingkat tanggung jawab dalam memberikan layanan kesehatan terbaik kepada pasien</p>
            </div>
            <div class="col-span-2"><img src="{{ asset('/assets/frontsite/images/bagan.png') }}" alt=""
                    class=""></div>

        </div>

        <div class="m-8 grid grid-cols-3 gap-4 justify-evenly text-[#1E2B4F]">
            <div>
                <h2 class="text-2xl font-semibold mb-4">Lokasi Rumah Sakit Nirwana</h2>
                <p class="mb-5">Jl. Panglima Batur Timur No 42 Kelurahan Lokatabat Utara Kec. Banjarbaru Utara.</p>
                <ul class="mb-5">

                    <li class="mb-5"><a href="https://www.google.com/search?q=nirwana+rsu+phone&sxsrf=ALiCzsbTO0wRTiiAtBH7NzGmRZ_7tVZSXQ%3A1666164652324&ei=rKdPY7asE_azz7sP7P2mWA&ved=0ahUKEwi2svSB4-v6AhX22XMBHey-CQsQ4dUDCA8&uact=5&oq=nirwana+rsu+phone&gs_lcp=Cgdnd3Mtd2l6EAMyBQghEKABMgUIIRCgAToKCAAQRxd"
                            class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium  py-2 px-4 rounded " target="_blank">
                            Telpon
                        </a></li>
                    <li class="mb-5"><a href="https://www.facebook.com/K.Nirwana1?mibextid=LQQJ4d"
                            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 py-2 px-4 rounded" target="_blank">
                           Facebook 
                        </a></li>
                    <li class="mb-5">
                      <a href="https://www.instagram.com/nirwanabanjarbaru/"
                          class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 py-2 px-4 rounded"  target="_blank">
                         Instagram 
                         
                      </a>
                  </li>
                </ul>
            </div>
            <div class="col-span-2">
                <a href="https://www.google.com/maps/place/Rumah+Sakit+Umum+Nirwana+Banjarbaru/@-3.4389042,114.8316937,15z/data=!4m6!3m5!1s0x2de6810937c2453b:0x15777bb0c8db4c58!8m2!3d-3.4392469!4d114.8404913!16s%2Fg%2F11b6dnqmf_?entry=ttu"
                    class="group" target="_blank" rel="noopener">
                    <div class="relative z-10 w-full h-[350px] rounded-2xl overflow-hidden">
                        <img src="{{ asset('/assets/frontsite/images/lokasi.png') }}"
                            class="w-full h-full bg-center bg-no-repeat object-cover object-center" alt="">
                        <div
                            class="opacity-0 group-hover:opacity-100 transition-all ease-in absolute inset-0 bg-[#0EFB71] bg-opacity-70 flex justify-center items-center">
                            <span class="text-[#0EFB71] font-medium bg-white rounded-full px-8 py-3">Google Maps</span>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </main>

@endsection
