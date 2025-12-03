@extends('layouts-auth.auth')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto bg-white/70 backdrop-blur-xl p-8 rounded-2xl shadow-2xl border border-white/40">

    <h2 class="text-2xl font-bold text-center text-purple-700 mb-6 tracking-tight">
        Buat Akun Baru
    </h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Username --}}
        <div>
            <label class="text-gray-700 text-sm font-medium">Username</label>
            <div class="mt-1 flex items-center border rounded-xl px-3 py-2 bg-gray-50/60 shadow-sm 
                        focus-within:ring-2 focus-within:ring-purple-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-purple-500" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A12.07 12.07 0 0112 15.75c2.554 
                             0 4.91.808 6.879 2.054M15 10.5a3 3 
                             0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <input type="text" name="username"
                       class="ml-3 w-full bg-transparent focus:outline-none"
                       placeholder="Buat username baru">
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label class="text-gray-700 text-sm font-medium">Password</label>
            <div class="mt-1 flex items-center border rounded-xl px-3 py-2 bg-gray-50/60 shadow-sm 
                        focus-within:ring-2 focus-within:ring-purple-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-purple-500" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.5 10.5V7.5a4.5 4.5 0 10-9 
                             0v3m-.75 0h10.5m-1.5 
                             0v6.75a2.25 2.25 0 01-2.25 
                             2.25H9.75a2.25 2.25 0 
                             01-2.25-2.25V10.5h10.5z"/>
                </svg>
                <input type="password" name="password"
                       class="ml-3 w-full bg-transparent focus:outline-none"
                       placeholder="Minimal 4 karakter">
            </div>
        </div>

        {{-- Errors --}}
        @if(session('success'))
            <p class="text-green-600 text-sm text-center font-medium">
                {{ session('success') }}
            </p>
        @endif

        @error('username')
            <p class="text-red-600 text-sm text-center font-medium">
                {{ $message }}
            </p>
        @enderror

        {{-- Button --}}
        <button
            class="w-full bg-purple-600 hover:bg-purple-700 transition text-white py-2.5 rounded-xl font-semibold shadow-lg">
            Daftar
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-purple-600 font-medium hover:underline">
                Login
            </a>
        </p>
    </form>
</div>
@endsection
