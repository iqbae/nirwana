@extends('layouts.default')

@section('title', 'Sign Up Success')

@section('content')

<!-- Content -->
<div class="min-h-screen flex justify-center items-center pt-20 py-28">
    <div class="mx-auto text-center">
        <img
            src="{{ asset('/assets/frontsite/images/success-regis.png') }}"
            class="inline-block"
            alt="Sign up success ilustration"
        />
        <div class="mt-12">
            <h2 class="text-[#1E2B4F] text-2xl font-semibold">Registrasi Berhasil</h2>

            <p class="text-[#AFAEC3] mt-4">Selamat menikmati kemudahan<br />dalam berkonsultasi</p>

            <a href="{{ route('index') }}" class="inline-block mt-10 bg-[#0EFB71] text-white rounded-full px-14 py-3">Beranda</a>
        </div>
    </div>
</div>
<!-- End Content -->

@endsection
