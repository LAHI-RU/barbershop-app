<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Barbershop LK') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            body { font-family: 'Inter', sans-serif; background: #050505; }
            h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }
            .bg-gold { background-color: #D4AF37; }
            .text-gold { color: #D4AF37; }
            .border-gold { border-color: #D4AF37; }
            
            /* Fix Date/Time Picker Icons for Dark Mode */
            input::-webkit-calendar-picker-indicator {
                filter: invert(1) brightness(0.8);
                cursor: pointer;
                transition: all 0.2s;
            }
            input:focus::-webkit-calendar-picker-indicator,
            input::-webkit-calendar-picker-indicator:hover {
                filter: invert(75%) sepia(50%) saturate(1000%) hue-rotate(5deg);
                brightness(1);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#050505] text-gray-200">
        <x-banner />

        <div class="min-h-screen bg-[#050505]">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-[#0a0a0a] border-b border-gray-900 shadow-xl">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <x-elite-confirm />

        @livewireScripts
    </body>
</html>
