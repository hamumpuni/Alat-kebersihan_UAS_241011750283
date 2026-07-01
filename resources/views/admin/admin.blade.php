<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIMAK</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-bg-soft">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-primary-dark text-white fixed left-0 top-0 h-screen">

        <div class="h-20 flex items-center px-8 border-b border-primary">
            <h1 class="text-2xl font-bold tracking-wide">
                SIMAK
            </h1>
        </div>

        <div class="mt-8">

            <p class="px-8 text-xs uppercase text-mint tracking-widest mb-3">
                Menu
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-8 py-3 bg-primary rounded-r-full mr-4">

                Dashboard
            </a>

            <a href="{{ route('admin.data-alat.index') }}"
               class="flex items-center gap-3 px-8 py-3 hover:bg-primary rounded-r-full mr-4">

                Data Alat
            </a>

        </div>

    </aside>

    <!-- Content -->
    <div class="ml-64 flex-1">

        <!-- Header -->
        <header class="bg-white h-20 shadow-sm flex items-center justify-between px-10">

            <h2 class="font-bold text-2xl text-ink">
                Dashboard
            </h2>

            <div class="flex items-center gap-5">

                <span class="font-semibold">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="text-red-500 font-semibold">
                        Logout
                    </button>

                </form>

            </div>

        </header>

        <main class="p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>