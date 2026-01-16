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
            body { 
                font-family: 'Inter', sans-serif; 
                background: #050505;
            }
            h1, h2, h3 { font-family: 'Playfair Display', serif; }
            .bg-gold { background-color: #D4AF37; }
            .text-gold { color: #D4AF37; }
            .border-gold { border-color: #D4AF37; }
            
            /* Custom Reveal Animations */
            @keyframes reveal {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .reveal {
                animation: reveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                opacity: 0;
            }
            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; }
            
            /* Modern Card Glassmorphism */
            .glass-card {
                background: rgba(20, 20, 20, 0.6);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
            .glass-card:hover {
                border-color: rgba(212, 175, 55, 0.3);
                background: rgba(25, 25, 25, 0.8);
            }
        </style>
    </head>
    <body class="antialiased bg-black text-gray-200 overflow-x-hidden">
        
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
        <section id="home" class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/herobg.webp') }}" class="w-full h-full object-cover object-top opacity-70" alt="Barbershop Background">
                <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black"></div>
            </div>
            
            <div class="relative z-10 text-center px-6 max-w-5xl mx-auto">
                <span class="text-gold font-bold tracking-[0.5em] uppercase text-xs mb-6 block reveal">Est. 2024 • Sri Lanka</span>
                <h1 class="text-6xl md:text-9xl font-black text-white mb-8 leading-[0.9] reveal delay-100 italic">PREMIUM <br> GROOMING</h1>
                <p class="text-lg md:text-2xl text-gray-400 mb-12 max-w-2xl mx-auto font-light leading-relaxed reveal delay-200">The ultimate destination for the modern gentleman. Precision cuts and luxury treatments in the heart of Colombo.</p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center reveal delay-300">
                    <a href="{{ route('register') }}" class="bg-gold text-black px-12 py-5 rounded-full font-black text-xl hover:bg-white transition-all duration-300 shadow-[0_0_30px_rgba(212,175,55,0.2)] hover:shadow-gold/40 tracking-widest uppercase">Reserve Now</a>
                    <a href="#services" class="border border-white/10 bg-white/5 px-12 py-5 rounded-full font-bold text-lg hover:bg-white/10 transition-all duration-300 backdrop-blur-md uppercase tracking-widest">Our Services</a>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center opacity-30">
                <span class="text-[10px] uppercase tracking-[0.3em] mb-4">Scroll</span>
                <div class="w-[1px] h-1/2 bg-gradient-to-b from-gold to-transparent"></div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-32 bg-[#050505]">
            <div class="max-w-7xl mx-auto px-6 sm:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-20">
                    <div class="reveal">
                        <h2 class="text-5xl md:text-7xl font-black mb-6 uppercase">The Menu</h2>
                        <div class="h-1.5 w-32 bg-gold mb-2"></div>
                    </div>
                    <p class="text-gray-500 max-w-sm reveal delay-100 text-lg">Curated grooming services designed to elevate your personal style.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @forelse($services as $index => $service)
                        <div class="glass-card group p-10 rounded-3xl transition-all duration-500 reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="flex justify-between items-start mb-10">
                                <div class="w-14 h-14 bg-gold/10 border border-gold/20 rounded-2xl flex items-center justify-center group-hover:bg-gold transition-all duration-500">
                                    <i class="fas fa-scissors text-gold group-hover:text-black text-2xl"></i>
                                </div>
                                <span class="text-3xl font-black text-white group-hover:text-gold transition-colors">{{ number_format($service->price, 0) }} <span class="text-xs text-gray-500">LKR</span></span>
                            </div>
                            <h3 class="text-3xl font-bold mb-4 text-white uppercase tracking-tight">{{ $service->name }}</h3>
                            <p class="text-gray-500 text-base mb-10 leading-relaxed font-light">{{ $service->description ?? 'Premium grooming service using the finest products.' }}</p>
                            <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-t border-white/5 pt-8">
                                <i class="far fa-clock mr-3 text-gold"></i>
                                {{ $service->duration_minutes }} Minutes Experience
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-24 text-gray-500 italic text-xl">Our service menu is being updated.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Barbers Section -->
        <section id="barbers" class="py-32 bg-black relative">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-gold/5 blur-3xl rounded-full translate-x-1/2"></div>
            
            <div class="max-w-7xl mx-auto px-6 sm:px-8 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-end mb-20">
                    <div class="reveal">
                        <h2 class="text-5xl md:text-7xl font-black mb-6 uppercase">Master Artisans</h2>
                        <div class="h-1.5 w-32 bg-gold"></div>
                    </div>
                    <p class="text-gray-500 max-w-md hidden md:block reveal delay-100 text-lg">Our team represents the pinnacle of traditional craft meeting modern aesthetics.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                    @forelse($barbers as $index => $barber)
                        <div class="group relative aspect-[3/4] overflow-hidden rounded-3xl bg-zinc-900 reveal" style="animation-delay: {{ $index * 0.15 }}s">
                            @if($barber->image_url)
                                <img src="{{ $barber->image_url }}" class="w-full h-full object-cover transition-all duration-[1.5s] group-hover:scale-110 grayscale hover:grayscale-0" alt="{{ $barber->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-800 bg-zinc-900">
                                    <i class="fas fa-user-circle text-9xl"></i>
                                </div>
                            @endif
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute bottom-0 left-0 p-8 w-full translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <h3 class="text-white text-3xl font-black mb-2">{{ $barber->name }}</h3>
                                <p class="text-gold text-[10px] font-black uppercase tracking-[0.3em] opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">{{ $barber->bio ?? 'Senior Stylist' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-24 text-gray-500 italic text-xl">The team is currently preparing for your arrival.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-40 relative overflow-hidden bg-[#0a0a0a]">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[800px] h-[800px] bg-gold/5 blur-[120px] rounded-full"></div>
            </div>
            
            <div class="max-w-4xl mx-auto px-6 relative z-10 text-center reveal">
                <span class="text-gold font-black tracking-[0.4em] uppercase text-[10px] mb-8 block">Exclusive Experience</span>
                <h2 class="text-5xl md:text-8xl font-black mb-10 leading-[0.9] uppercase text-white">REDESIGN <br> YOURSELF</h2>
                <p class="text-gray-400 mb-16 text-xl font-light max-w-2xl mx-auto leading-relaxed">Each appointment is more than just a cut; it's a statement of style and precision.</p>
                <div class="flex justify-center">
                    <a href="{{ route('register') }}" class="bg-white text-black px-16 py-6 rounded-full font-black text-2xl hover:bg-gold transition-all duration-300 shadow-2xl hover:shadow-gold/20 tracking-wider uppercase">Book The Experience</a>
                </div>
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
