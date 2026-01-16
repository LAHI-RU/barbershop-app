<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight">
                    {{ __('My Dashboard') }}
                </h2>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-gold border border-transparent rounded-xl font-black text-xs text-black uppercase tracking-[0.2em] hover:bg-white transition duration-300 shadow-lg shadow-gold/20">
                <i class="fas fa-plus mr-2 text-[10px]"></i> {{ __('Book Appointment') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Appointments -->
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Sessions</p>
                            <p class="text-4xl font-black text-gray-900 dark:text-white">{{ Auth::user()->appointments()->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gold/10 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-calendar-check text-gold text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Upcoming</p>
                            <p class="text-4xl font-black text-gray-900 dark:text-white">{{ Auth::user()->appointments()->whereIn('status', ['pending', 'confirmed'])->where('appointment_date', '>=', now())->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-emerald-900/20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-clock text-emerald-400 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Completed</p>
                            <p class="text-4xl font-black text-gray-900 dark:text-white">{{ Auth::user()->appointments()->where('status', 'completed')->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gold/10 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-gold text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Appointment Highlight -->
            @php
                $nextAppointment = Auth::user()->appointments()
                    ->with(['barber', 'service'])
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->where('appointment_date', '>=', now())
                    ->orderBy('appointment_date')
                    ->orderBy('start_time')
                    ->first();
            @endphp

            @if($nextAppointment)
                <div class="bg-gradient-to-br from-gold-600 to-gold-800 rounded-[2.5rem] p-10 shadow-2xl shadow-gold-500/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-star text-yellow-400 text-xl mr-3"></i>
                            <span class="text-[10px] font-black text-gold-200 uppercase tracking-[0.3em]">Your Next Session</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div>
                                <p class="text-xs font-bold text-gold-200 uppercase tracking-wider mb-2">Service</p>
                                <p class="text-2xl font-black text-white">{{ $nextAppointment->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gold-200 uppercase tracking-wider mb-2">Barber</p>
                                <p class="text-2xl font-black text-white">{{ $nextAppointment->barber->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gold-200 uppercase tracking-wider mb-2">Date & Time</p>
                                <p class="text-2xl font-black text-white">{{ \Carbon\Carbon::parse($nextAppointment->appointment_date)->format('M d, Y') }}</p>
                                <p class="text-sm font-bold text-gold-200">{{ \Carbon\Carbon::parse($nextAppointment->start_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <div class="mt-8 flex items-center justify-between">
                            <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-xl text-xs font-black text-white uppercase tracking-widest">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></span>
                                {{ ucfirst($nextAppointment->status) }}
                            </span>
                            <a href="{{ route('appointments.index') }}" class="text-xs font-black text-white hover:text-gold-200 transition uppercase tracking-widest">
                                View All Appointments →
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Upcoming Appointments - CTA -->
                <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md rounded-[2.5rem] p-16 shadow-2xl shadow-black/5 border border-gray-100 dark:border-gray-800 text-center">
                    <div class="w-24 h-24 bg-gold-50 dark:bg-gold-900/30 rounded-full flex items-center justify-center mb-8 mx-auto">
                        <i class="fas fa-calendar-plus text-gold-600 dark:text-gold-400 text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-4">Ready for Your Next Look?</h3>
                    <p class="text-gray-500 font-medium text-sm mb-10 max-w-md mx-auto uppercase tracking-wide">
                        Book your next premium grooming session with our expert barbers
                    </p>
                    <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-12 py-5 bg-gold-600 text-white font-black text-sm uppercase tracking-[0.2em] rounded-2xl hover:bg-black transition-all duration-300 shadow-xl shadow-gold-500/20">
                        <i class="fas fa-scissors mr-3"></i> Book Your Session
                    </a>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- View All Appointments -->
                <a href="{{ route('appointments.index') }}" class="group bg-white dark:bg-gray-900/50 backdrop-blur-md rounded-[2rem] p-8 shadow-2xl shadow-black/5 border border-gray-100 dark:border-gray-800 hover:border-gold-500/30 transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gold-50 dark:bg-gold-900/30 rounded-2xl flex items-center justify-center group-hover:bg-gold-600 transition-all duration-300">
                            <i class="fas fa-history text-gold-600 dark:text-gold-400 text-xl group-hover:text-white"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-gold-600 transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">Appointment History</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">View all your past and upcoming sessions</p>
                </a>

                <!-- Book New Appointment -->
                <a href="{{ route('appointments.create') }}" class="group bg-gradient-to-br from-gold-600 to-gold-800 rounded-[2rem] p-8 shadow-2xl shadow-gold-500/20 hover:shadow-gold-500/40 transition-all duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-calendar-plus text-white text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-white/60 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-tight mb-2">Book New Session</h3>
                    <p class="text-xs font-bold text-gold-200 uppercase tracking-wider">Reserve your next premium experience</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
