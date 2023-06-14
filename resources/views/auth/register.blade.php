@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<div class="px-4 lg:px-[91px] pt-10 pb-12">
<!-- Logo Brand -->
                <a
                    href="{{ route('index') }}"
                    class="flex-shrink-0 inline-flex items-center"
                >

                    <img
                        class="h-12 lg:h-16 py-11"
                        src="{{ asset('/assets/frontsite/images/logo.png') }}"
                        alt="Meet Doctor Logo"
                    />

                </a>
            </div>
    <div class="min-h-screen">
        <div class="grid lg:grid-cols-2">
            <!-- Form -->
            <div class="px-4 lg:px-[91px] pt-10">

                

                <div class="flex flex-col justify-center py-20 h-screen lg:min-h-screen">
                    <h2 class="text-[#1E2B4F] text-2xl font-semibold leading-normal">
                        Tingkatkan Kesehatan Anda <br />
                        Kesehatan Bersama Ahli-nya
                        
                    </h2>
                    <div class="mt-12">

                        <!-- Form input -->
                        <form method="POST" action="{{ route('register') }}" class="grid gap-6">

                            {{-- token here --}}
                            @csrf

                            <label class="block">
                                <input
                                    for="name" type="text" id="name" name="name"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] border-none  "
                                    placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus
                                />

                                @if ($errors->has('name'))
                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                                @endif
                            </label>

                            <label class="block">
                                <input
                                    for="email" type="email" id="email" name="email"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0EFB71]"
                                    placeholder="Alamat Email" value="{{ old('email') }}" required autofocus
                                />

                                @if ($errors->has('email'))
                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                                @endif
                            </label>

                            <label class="block">
                                <input
                                    for="password" type="password" id="password" name="password"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0EFB71]"
                                    placeholder="Password" value="{{ old('password') }}" required autofocus
                                />
                            </label>

                            <label class="block">
                                <input
                                    for="password_confirmation" type="password" id="password_confirmation" name="password_confirmation"
                                    class="block w-full rounded-full py-4 text-[#1E2B4F] font-medium placeholder:text-[#AFAEC3] placeholder:font-normal px-7 border border-[#d4d4d4] focus:outline-none focus:border-[#0EFB71]"
                                    placeholder="Konfirmasi Password" required autofocus
                                />

                                @if ($errors->has('password'))
                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('password') }}</p>
                                @endif
                            </label>

                            <div class="mt-10 grid gap-6 ">
                                <button type="submit" class="text-center text-white text-lg font-medium bg-[#0EFB71] px-10 py-4 rounded-full">
                                    Continue
                                </button>
                                    
                                <a href="{{ route('login') }}" class="text-center text-lg text-[#1E2B4F] font-medium bg-[#E0E0E0] px-10 py-4 rounded-full">
                                    Masuk
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- End Form -->

            <!-- Qoute -->
            <div class="hidden sm:block bg-[#F9FBFC]">
                <div class="flex flex-col justify-center h-full px-24 pt-10 pb-20">
                    <div class="relative">
                        <div class="relative top-0 -left-5 mb-7">
                            <img
                                src="{{ asset('/assets/frontsite/images/blockqoutation.svg') }}"
                                class="h-[30px]"
                                alt=""
                            />
                        </div>

                        <p class="text-2xl leading-loose">
                            Mens Sana in Corpore Sano dalam tubuh yang sehat terdapat jiwa yang kuat.
                        </p>

                        <div class="flex-shrink-0 group block mt-7">
                            <div class="flex items-center">
                                <div class="ring-1 ring-[#0EFB71] ring-offset-4 rounded-full">
                                    <img
                                        class="inline-block h-14 w-14 rounded-full"
                                        src="{{ asset('/assets/frontsite/images/patient-testimonial.png') }}"
                                        alt=""
                                    />
                                </div>
                                <div class="ml-5">
                                    <p class="font-medium text-[#1E2B4F]"> Decimus Iunius Juvenalis</p>
                                    <p class="text-sm text-[#AFAEC3]">Product Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Qoute -->
        </div>
    </div>

@endsection
