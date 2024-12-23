@extends('components.layout')

@section('title', 'Login')

@section('content')
    <style>
        body {
            background-color: white !important;
        }
    </style>

    <div class="flex min-h-screen items-center justify-center bg-white">
        <div class="mx-auto max-w-md">
            <div class="text-center">
                <a href="/" class="">
                    <img src="{{ asset('img/jsn.png') }}" alt="Logo-JSN" class="mx-auto mb-4 w-20">
                    <h2 class="text-2xl font-bold text-gray-700">Login</h2>
                </a>
            </div>
            <p class="mt-2 text-sm text-gray-600">Silahkan login menggunakan akun yang sudah terdaftar.</p>

            {{-- Menampilkan pesan kesalahan di atas form --}}
            @if ($errors->any())
                <div class="mb-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Menampilkan debug data jika ada --}}
            @if (session('debug_data'))
                <div class="mb-4 p-4 bg-yellow-100 text-yellow-900 rounded">
                    <h3 class="font-bold mb-2">Debug Data</h3>
                    <pre class="text-sm">{{ print_r(session('debug_data'), true) }}</pre>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-5">
                @csrf
                <div class="mb-3 md:mb-4">
                    <label for="username" class="mb-2 block text-sm font-medium text-gray-700 md:text-base">
                        Email atau Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="username" name="username_or_email" value="{{ old('username_or_email') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-base" placeholder="Masukkan email atau username" required>
                </div>

                <div x-data="{ show: false }" class="relative mb-4">
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password" class="w-full rounded-md border border-gray-300 px-3 py-2 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-base" placeholder="*****" required>
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mb-2 text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot your password?</a>
                </div>
                <button type="submit" class="w-full rounded-md bg-blue-600 py-2 text-sm text-white transition-colors duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 md:text-base">Login</button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">Belum memiliki akun? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar</a></p>
        </div>
    </div>
@endsection
