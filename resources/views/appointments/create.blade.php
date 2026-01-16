<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight">
                {{ __('Reserve Your Slot') }}
            </h2>
            <div class="text-xs font-bold text-gold uppercase tracking-widest bg-gold/5 px-4 py-2 rounded-full border border-gold/20">
                <i class="fas fa-magic mr-2"></i> Custom Experience
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2.5rem] border border-gray-100 dark:border-gray-800">
                <div class="p-10 md:p-16">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Select Barber -->
                            <div class="space-y-3">
                                <label for="barber_id" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Master Artisan</label>
                                <select name="barber_id" id="barber_id" class="block w-full bg-black/50 dark:bg-black/50 border border-gray-800 rounded-2xl p-4 text-sm font-bold text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gold focus:border-gold transition-all" required>
                                    <option value="" class="bg-white text-black font-medium">-- Choose Your Barber --</option>
                                    @foreach($barbers as $barber)
                                        <option value="{{ $barber->id }}" class="bg-white text-black" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                            {{ $barber->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="barber_id" class="mt-2" />
                            </div>

                            <!-- Select Service -->
                            <div class="space-y-3">
                                <label for="service_id" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Select Service</label>
                                <select name="service_id" id="service_id" class="block w-full bg-black/50 dark:bg-black/50 border border-gray-800 rounded-2xl p-4 text-sm font-bold text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gold focus:border-gold transition-all" required>
                                    <option value="" class="bg-white text-black font-medium">-- Choose A Service --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" class="bg-white text-black" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} (LKR {{ number_format($service->price, 0) }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="service_id" class="mt-2" />
                            </div>

                            <!-- Date -->
                            <div class="space-y-3">
                                <label for="appointment_date" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Arrival Date</label>
                                <input id="appointment_date" class="block w-full bg-black/50 dark:bg-black/50 border border-gray-800 rounded-2xl p-4 text-sm font-bold text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gold focus:border-gold transition-all" type="date" name="appointment_date" value="{{ old('appointment_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required />
                                <x-input-error for="appointment_date" class="mt-2" />
                            </div>

                            <!-- Time -->
                            <div class="space-y-3">
                                <label for="start_time" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Preferred Time</label>
                                <input id="start_time" class="block w-full bg-black/50 dark:bg-black/50 border border-gray-800 rounded-2xl p-4 text-sm font-bold text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gold focus:border-gold transition-all" type="time" name="start_time" value="{{ old('start_time') }}" required />
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mt-2 ml-1">Hours: 09:00 AM - 07:00 PM</p>
                                <x-input-error for="start_time" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2 space-y-3">
                                <label for="notes" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Artisan Notes (Optional)</label>
                                <textarea name="notes" id="notes" rows="3" class="block w-full bg-black/50 dark:bg-black/50 border border-gray-800 rounded-2xl p-4 text-sm font-medium text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gold focus:border-gold transition-all" placeholder="Any specific requirements for your look?">{{ old('notes') }}</textarea>
                                <x-input-error for="notes" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-12">
                            <button type="submit" class="w-full md:w-auto px-12 py-5 bg-gold text-black font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-white transition-all duration-300 shadow-xl shadow-gold/20 active:scale-95">
                                {{ __('Request Booking') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Concierge Advice -->
            <div class="mt-12 bg-gray-50 dark:bg-gray-900/40 p-10 rounded-[2rem] border border-gray-100 dark:border-gray-800 relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-xs font-black text-gold uppercase tracking-[0.3em] mb-6">Concierge Advice</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-widest leading-loose">
                        <li class="flex items-center"><span class="w-1.5 h-1.5 bg-gold-500 rounded-full mr-3"></span> Review process applies to all slots.</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 bg-gold-500 rounded-full mr-3"></span> 5-minute early arrival is recommended.</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 bg-gold-500 rounded-full mr-3"></span> 2-hour cancellation notice required.</li>
                        <li class="flex items-center"><span class="w-1.5 h-1.5 bg-gold-500 rounded-full mr-3"></span> Prices may vary mid-treatment.</li>
                    </ul>
                </div>
                <i class="fas fa-info-circle absolute top-[-20px] right-[-20px] text-[8rem] text-gray-200 dark:text-gray-800 opacity-20 group-hover:rotate-12 transition-transform duration-700"></i>
            </div>
        </div>
    </div>
</x-app-layout>
