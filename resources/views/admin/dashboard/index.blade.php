<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Administrative Overview') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full border border-gray-200 dark:border-gray-700">
                <i class="fas fa-calendar-alt text-indigo-500"></i>
                <span class="font-medium tracking-wide uppercase">{{ date('l, F j, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Total Revenue -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 dark:border-gray-700/50 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Total Revenue</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white leading-none"><span class="text-sm font-medium text-green-500 mr-1">LKR</span> {{ number_format($totalRevenue, 0) }}</p>
                        </div>
                        <div class="p-4 bg-green-50 dark:bg-green-500/10 rounded-2xl">
                            <i class="fas fa-coins text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Appointments Today -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 dark:border-gray-700/50 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Today's Bookings</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white leading-none">{{ $appointmentsToday }}</p>
                        </div>
                        <div class="p-4 bg-indigo-50 dark:bg-indigo-500/10 rounded-2xl">
                            <i class="fas fa-calendar-check text-indigo-600 dark:text-indigo-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Barbers -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 dark:border-gray-700/50 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3">On Duty</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white leading-none">{{ $totalBarbers }}</p>
                        </div>
                        <div class="p-4 bg-blue-50 dark:bg-blue-500/10 rounded-2xl">
                            <i class="fas fa-user-tie text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 dark:border-gray-700/50 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Awaiting Action</p>
                            <p class="text-3xl font-black text-gray-900 dark:text-white leading-none">{{ $pendingAppointments }}</p>
                        </div>
                        <div class="p-4 bg-amber-50 dark:bg-amber-500/10 rounded-2xl text-amber-600 dark:text-amber-400">
                            <i class="fas fa-hourglass-half text-xl animate-pulse"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Today's Schedule -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-xl shadow-black/5 overflow-hidden border border-gray-100 dark:border-gray-800/50">
                        <div class="p-8 border-b border-gray-50 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900">
                            <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Today's Schedule</h3>
                            <a href="{{ route('admin.appointments.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-widest transition">Full Calendar &rarr;</a>
                        </div>
                        <div class="p-0">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                                    <thead class="bg-white dark:bg-gray-900">
                                        <tr>
                                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Arrival</th>
                                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Client & Service</th>
                                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Master Barber</th>
                                            <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                                        @forelse($todaysSchedule as $appt)
                                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="inline-flex items-center px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                                        <span class="text-sm font-black text-indigo-600 dark:text-indigo-400 tracking-tight">
                                                            {{ \Carbon\Carbon::parse($appt->start_time)->format('h:i A') }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-sm font-black text-gray-900 dark:text-white">{{ $appt->user->name }}</div>
                                                    <div class="text-xs text-gray-400 font-medium">{{ $appt->service->name }}</div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                                            <i class="fas fa-user text-[10px] text-gray-500"></i>
                                                        </div>
                                                        <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $appt->barber->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap text-center">
                                                    @if($appt->status === 'pending')
                                                        <span class="inline-flex items-center px-2.5 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 rounded-md text-[10px] font-black uppercase tracking-wider">Pending</span>
                                                    @elseif($appt->status === 'confirmed')
                                                        <span class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-md text-[10px] font-black uppercase tracking-wider">Confirmed</span>
                                                    @elseif($appt->status === 'completed')
                                                        <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 rounded-md text-[10px] font-black uppercase tracking-wider">Completed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-8 py-20 text-center">
                                                    <div class="flex flex-col items-center">
                                                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                                            <i class="fas fa-calendar-day text-gray-300 text-2xl"></i>
                                                        </div>
                                                        <p class="text-gray-400 italic text-sm font-medium">No appointments scheduled for today.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Actions -->
                <div class="space-y-10">
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl shadow-black/5 border border-gray-100 dark:border-gray-700/30">
                        <h3 class="text-sm font-black text-gray-400 uppercase tracking-[0.2em] mb-8">Business Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('barbers.create') }}" class="group flex items-center p-4 rounded-2xl bg-gray-50 dark:bg-gray-900/50 hover:bg-indigo-600 transition-all duration-300 border border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-300 hover:text-white">
                                <div class="w-10 h-10 bg-white dark:bg-gray-800 text-indigo-600 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-plus text-sm"></i>
                                </div>
                                <span class="ml-4 text-sm font-bold tracking-tight">Onboard Barber</span>
                            </a>
                            <a href="{{ route('services.create') }}" class="group flex items-center p-4 rounded-2xl bg-gray-50 dark:bg-gray-900/50 hover:bg-emerald-600 transition-all duration-300 border border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-300 hover:text-white">
                                <div class="w-10 h-10 bg-white dark:bg-gray-800 text-emerald-600 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-scissors text-sm"></i>
                                </div>
                                <span class="ml-4 text-sm font-bold tracking-tight">Configure Menu</span>
                            </a>
                        </div>
                    </div>

                    <!-- Promo/Status Card -->
                    <div class="bg-indigo-700 rounded-[2rem] p-10 text-white shadow-2xl shadow-indigo-500/20 overflow-hidden relative group">
                        <div class="relative z-10">
                            <h3 class="text-3xl font-black mb-4 leading-tight">SHOP PERFORMANCE</h3>
                            <p class="text-indigo-100/80 text-sm mb-10 font-medium leading-relaxed">
                                You currently have <span class="text-white font-black">{{ $totalBarbers }}</span> artisans active. 
                                @if($totalRevenue > 0)
                                    Keep up the excellent momentum!
                                @else
                                    Ready for a fresh start today.
                                @endif
                            </p>
                            <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-50 transition shadow-lg">
                                Manage Flow <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                            </a>
                        </div>
                        <i class="fas fa-chart-line absolute bottom-[-30px] right-[-30px] text-[12rem] text-indigo-600 opacity-20 group-hover:rotate-12 transition-transform duration-700"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
