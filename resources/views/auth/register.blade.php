<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - {{ config('app.name', 'Barbershop LK') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .bg-gold { background-color: #D4AF37; }
        .text-gold { color: #D4AF37; }
    </style>
</head>
<body class="antialiased bg-black text-gray-200 overflow-x-hidden">
    <div class="min-h-screen flex">
        <!-- Left Side - Background Image -->
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/herobg.webp') }}" class="absolute inset-0 w-full h-full object-cover" alt="Barbershop">
            <div class="absolute inset-0 bg-gradient-to-l from-black via-black/50 to-transparent"></div>
            
            <!-- Decorative Content -->
            <div class="absolute inset-0 flex items-center justify-center p-16">
                <div class="text-center">
                    <span class="text-gold font-black tracking-[0.5em] uppercase text-xs mb-6 block">Join The Elite</span>
                    <h2 class="text-6xl font-black text-white mb-6 leading-[0.9] italic">REDEFINE<br>EXCELLENCE</h2>
                    <p class="text-gray-400 text-lg font-light max-w-md mx-auto">Experience grooming at its finest</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 relative z-10">
            <div class="w-full max-w-md">
                <!-- Logo/Brand -->
                <a href="{{ route('home') }}" class="inline-block mb-12">
                    <span class="text-3xl font-black tracking-tighter text-white">BARBER<span class="text-gold">SHOP</span>.LK</span>
                </a>

                <!-- Header -->
                <div class="mb-10">
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-3 uppercase italic">Join Us</h1>
                    <p class="text-gray-400 text-sm font-medium">Create your account and book your first premium experience</p>
                </div>

                <!-- Validation Errors -->
                <x-validation-errors class="mb-6 p-4 bg-rose-900/20 border border-rose-800 rounded-2xl text-rose-400 text-sm" />

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                            class="block w-full bg-gray-900/50 border border-gray-800 rounded-2xl p-4 text-sm font-medium text-white focus:ring-2 focus:ring-gold focus:border-transparent transition-all placeholder:text-gray-600" 
                            placeholder="John Doe">
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                            class="block w-full bg-gray-900/50 border border-gray-800 rounded-2xl p-4 text-sm font-medium text-white focus:ring-2 focus:ring-gold focus:border-transparent transition-all placeholder:text-gray-600" 
                            placeholder="your@email.com">
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" 
                            class="block w-full bg-gray-900/50 border border-gray-800 rounded-2xl p-4 text-sm font-medium text-white focus:ring-2 focus:ring-gold focus:border-transparent transition-all placeholder:text-gray-600" 
                            placeholder="••••••••">
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                            class="block w-full bg-gray-900/50 border border-gray-800 rounded-2xl p-4 text-sm font-medium text-white focus:ring-2 focus:ring-gold focus:border-transparent transition-all placeholder:text-gray-600" 
                            placeholder="••••••••">
                    </div>

                    <!-- Terms & Privacy (if enabled) -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="space-y-2">
                            <label for="terms" class="flex items-start cursor-pointer group">
                                <input id="terms" type="checkbox" name="terms" required class="w-4 h-4 mt-0.5 rounded border-gray-700 bg-gray-900 text-gold focus:ring-gold focus:ring-offset-0">
                                <span class="ml-3 text-xs font-medium text-gray-400 group-hover:text-white transition leading-relaxed">
                                    I agree to the 
                                    <a href="{{ route('terms.show') }}" target="_blank" class="text-gold hover:text-white underline">Terms of Service</a>
                                    and 
                                    <a href="{{ route('policy.show') }}" target="_blank" class="text-gold hover:text-white underline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gold text-black px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-white transition-all duration-300 shadow-lg shadow-gold/20 hover:shadow-gold/40">
                        Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-gold hover:text-white transition ml-1">Sign In</a>
                    </p>
                </div>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-[10px] font-black text-gray-600 hover:text-gold transition uppercase tracking-[0.3em]">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
