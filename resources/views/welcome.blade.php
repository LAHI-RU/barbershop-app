<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Barbershop LK') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html { scroll-behavior: smooth; }
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3 { font-family: 'Playfair Display', serif; }
            .bg-gold { background-color: #D4AF37; }
            .text-gold { color: #D4AF37; }
            .border-gold { border-color: #D4AF37; }
        </style>
    </head>
    <body class="antialiased bg-black text-gray-200">
        
        <!-- Navigation -->
        <nav class="fixed w-full z-50 bg-black/80 backdrop-blur-md border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center">
                        <span class="text-2xl font-black tracking-tighter text-white">BARBER<span class="text-gold">SHOP</span>.LK</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="#home" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition">Home</a>
                            <a href="#services" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition">Services</a>
                            <a href="#barbers" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition">Barbers</a>
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="bg-gold text-black px-5 py-2 rounded-full text-sm font-bold transition hover:bg-white">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Log in</a>
                                    <a href="{{ route('register') }}" class="bg-gold text-black px-6 py-2 rounded-full text-sm font-bold transition hover:bg-white shadow-[0_0_15px_rgba(212,175,55,0.4)]">Book Now</a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-40" alt="Barbershop Background">
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black"></div>
            </div>
            
            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
                <span class="text-gold font-bold tracking-[0.3em] uppercase text-sm mb-4 block animate-fade-in-down">Est. 2024 • Sri Lanka</span>
                <h1 class="text-5xl md:text-8xl font-black text-white mb-6 leading-tight">PREMIUM GROOMING <br> FOR THE MODERN MAN</h1>
                <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-light leading-relaxed">Experience the ultimate in traditional barbering and modern styling. Precision, style, and luxury in every cut.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-gold text-black px-10 py-4 rounded-full font-black text-lg hover:bg-white transition shadow-2xl shadow-gold/20 tracking-wide uppercase">Reserve Your Slot</a>
                    <a href="#services" class="border border-white/20 px-10 py-4 rounded-full font-bold text-lg hover:bg-white/10 transition backdrop-blur-sm uppercase">Our Services</a>
                </div>
            </div>
            
            <!-- Floating Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center">
                <div class="w-[1px] h-20 bg-gradient-to-b from-gold to-transparent"></div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-24 bg-zinc-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-black mb-4">SUPERIOR SERVICES</h2>
                    <div class="h-1 w-24 bg-gold mx-auto mb-6"></div>
                    <p class="text-gray-500 max-w-xl mx-auto">From signature haircuts to beard sculpting and facial treatments, we offer a range of specialized services tailored to your style.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($services as $service)
                        <div class="group p-8 bg-zinc-900 border border-gray-800 rounded-2xl hover:border-gold/50 transition duration-500">
                            <div class="flex justify-between items-start mb-6">
                                <div class="p-3 bg-gold/10 rounded-xl">
                                    <i class="fas fa-scissors text-gold text-xl"></i>
                                </div>
                                <span class="text-2xl font-black text-white">LKR {{ number_format($service->price, 0) }}</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-white group-hover:text-gold transition">{{ $service->name }}</h3>
                            <p class="text-gray-500 text-sm mb-6 leading-relaxed">{{ $service->description ?? 'Premium grooming service using the finest products.' }}</p>
                            <div class="flex items-center text-xs font-bold text-gray-400 uppercase tracking-widest border-t border-gray-800 pt-6">
                                <i class="far fa-clock mr-2 text-gold"></i>
                                {{ $service->duration_minutes }} Minutes
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500 italic">No services listed yet. Come back soon!</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Barbers Section -->
        <section id="barbers" class="py-24 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black mb-4">MEET THE MASTERS</h2>
                        <div class="h-1 w-24 bg-gold mb-6"></div>
                    </div>
                    <p class="text-gray-500 max-w-md hidden md:block">Our barbers are more than just stylists – they're masters of their craft with years of experience and sharp attention to detail.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($barbers as $barber)
                        <div class="group relative aspect-[3/4] overflow-hidden rounded-2xl bg-zinc-900">
                            @if($barber->image_url)
                                <img src="{{ Storage::url($barber->image_url) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110 grayscale hover:grayscale-0" alt="{{ $barber->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-700">
                                    <i class="fas fa-user-circle text-8xl"></i>
                                </div>
                            @endif
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90"></div>
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-white text-2xl font-bold mb-1">{{ $barber->name }}</h3>
                                <p class="text-gold text-xs font-bold uppercase tracking-widest truncate">{{ $barber->bio ?? 'Senior Stylist' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500 italic">Our team is getting ready. Check back soon!</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-gold opacity-10 blur-3xl rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
                <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight">READY FOR A NEW LOOK?</h2>
                <p class="text-gray-400 mb-12 text-lg">Join the hundreds of dapper gentlemen who trust BARBERSHOP.LK with their style. Booking takes less than 60 seconds.</p>
                <a href="{{ route('register') }}" class="bg-white text-black px-12 py-5 rounded-full font-black text-xl hover:bg-gold transition shadow-2xl shadow-gold/10 tracking-widest">SECURE YOUR APPOINTMENT</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-zinc-950 border-t border-gray-900 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-2">
                        <span class="text-2xl font-black tracking-tighter text-white block mb-6">BARBER<span class="text-gold">SHOP</span>.LK</span>
                        <p class="text-gray-500 max-w-sm mb-8 leading-relaxed">The premier destination for the modern man. Located in the heart of Sri Lanka, we provide world-class grooming services in a premium, relaxed environment.</p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-gold hover:text-black transition"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-gold hover:text-black transition"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-gold hover:text-black transition"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 italic uppercase tracking-widest">Opening Hours</h4>
                        <ul class="text-sm text-gray-500 space-y-3">
                            <li class="flex justify-between"><span>Mon - Sat</span> <span>9:00 AM - 8:00 PM</span></li>
                            <li class="flex justify-between"><span>Sunday</span> <span>10:00 AM - 4:00 PM</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6 italic uppercase tracking-widest">Location</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">123 Galle Road,<br>Colombo 03,<br>Sri Lanka</p>
                    </div>
                </div>
                <div class="border-t border-gray-900 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-600 font-bold tracking-widest uppercase">
                    <p>&copy; {{ date('Y') }} BARBERSHOP.LK. ALL RIGHTS RESERVED.</p>
                    <p>Designed for Excellence</p>
                </div>
            </div>
        </footer>

    </body>
</html>
