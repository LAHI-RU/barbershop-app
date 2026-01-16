<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight">
                {{ __('My Grooming History') }}
            </h2>
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-gold border border-transparent rounded-xl font-black text-xs text-black uppercase tracking-[0.2em] hover:bg-white transition duration-300 shadow-lg shadow-gold/20">
                <i class="fas fa-plus mr-2 text-[10px]"></i> {{ __('Book New Experience') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-8 p-5 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-2xl flex items-center text-emerald-800 dark:text-emerald-400">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span class="text-sm font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="space-y-6">
                @forelse($appointments as $appointment)
                    <div class="bg-white dark:bg-gray-900/40 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800 p-8 hover:border-gold/30 transition-all duration-300 group">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                            <div class="flex items-start gap-8">
                                <!-- Date Badge -->
                                <div class="bg-gold/5 dark:bg-gold/10 p-5 rounded-2xl flex flex-col items-center justify-center min-w-[100px] border border-gold/10 dark:border-gold/10 group-hover:bg-[#0a0a0a] group-hover:border-gold transition-all duration-500">
                                    <span class="text-[10px] uppercase font-black text-gold/60 dark:text-gold/60 group-hover:text-gold/90 tracking-[0.3em] mb-1">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</span>
                                    <span class="text-3xl font-black text-gold dark:text-white group-hover:text-white leading-none">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d') }}</span>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $appointment->service->name }}</h3>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">
                                            Curated by <span class="text-gold">{{ $appointment->barber->name }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="flex flex-wrap items-center gap-6">
                                        <span class="flex items-center text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                            <i class="far fa-clock mr-2 text-gold"></i> {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                        </span>
                                        <span class="flex items-center text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                            <i class="fas fa-coins mr-2 text-emerald-500"></i> LKR {{ number_format($appointment->total_price, 0) }}
                                        </span>
                                        <span class="flex items-center text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                            <i class="fas fa-stopwatch mr-2 text-gold"></i> {{ $appointment->service->duration_minutes }} Mins
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between md:justify-end gap-10 text-right">
                                <div class="flex flex-col items-end">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Booking Status</span>
                                    @if($appointment->status === 'pending')
                                        <span class="px-4 py-1.5 bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Pending Review</span>
                                    @elseif($appointment->status === 'confirmed')
                                        <span class="px-4 py-1.5 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Confirmed Slot</span>
                                    @elseif($appointment->status === 'completed')
                                        <span class="px-4 py-1.5 bg-gold/10 text-gold rounded-lg text-[10px] font-black uppercase tracking-widest border border-gold/20">Completed</span>
                                    @else
                                        <span class="px-4 py-1.5 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Cancelled</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[3rem] border border-gray-100 dark:border-gray-800 p-20 text-center">
                        <div class="w-24 h-24 bg-gold/5 dark:bg-gold/10 rounded-full flex items-center justify-center mb-8 mx-auto border border-gold/10">
                            <i class="fas fa-calendar-times text-gold text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-4">No Sessions Yet</h3>
                        <p class="text-gray-500 font-medium text-sm mb-10 max-w-sm mx-auto uppercase tracking-wide">Ready for a transformation? Your first premium experience is just a click away.</p>
                        <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-10 py-4 bg-gold text-black font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-white transition-all shadow-xl shadow-gold/10">
                            Book Now
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
