@extends('layouts.app')

@section('content')
<div
    class="min-h-screen font-sans relative overflow-hidden flex flex-col bg-cover bg-center"
    style="background-image: url('https://images.unsplash.com/photo-1528740561666-dc2479dc08ab?auto=format&fit=crop&w=1740&q=80');"
>
    <!-- Overlay gelap tipis + tint hijau tema SIMAK agar form tetap terbaca -->
    <div class="absolute inset-0 bg-primary-dark/70"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/50"></div>

    <!-- ============ Logo di atas ============ -->
    <div class="relative z-10 px-6 md:px-12 py-8">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-white font-bold text-xl w-fit drop-shadow-sm">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span>SIMAK</span>
        </a>
    </div>

    <!-- ============ Card Login ============ -->
    <div class="relative z-10 flex-1 flex items-center justify-center px-6 pb-16">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-mint-soft p-8 md:p-10">

            <h1 class="text-2xl md:text-3xl font-extrabold text-ink text-center mb-1">Login Admin</h1>
            <p class="text-ink-soft text-sm text-center mb-8">Masuk untuk mengelola data inventaris SIMAK.</p>

            @if($errors->any())
                <div class="mb-6 bg-red-50 text-red-600 text-sm font-medium px-4 py-3 rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-semibold text-ink mb-2">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        class="w-full border border-mint-soft rounded-xl px-4 py-3 text-ink focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-ink mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full border border-mint-soft rounded-xl px-4 py-3 text-ink focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition-all shadow-md hover:shadow-lg mt-2"
                >
                    Masuk Sekarang
                </button>
            </form>

        </div>
    </div>

</div>
@endsection