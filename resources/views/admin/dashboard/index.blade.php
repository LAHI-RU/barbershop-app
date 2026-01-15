<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Revenue -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full">
                            <i class="fas fa-coins text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Revenue</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">LKR {{ number_format($totalRevenue, 0) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Appointments Today -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-full">
                            <i class="fas fa-calendar-check text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Appointments Today</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $appointmentsToday }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Barbers -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                            <i class="fas fa-user-tie text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Active Barbers</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalBarbers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-full">
                            <i class="fas fa-clock text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Pending Approvals</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingAppointments }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Today's Schedule -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Today's Schedule</h3>
                            <span class="text-xs font-semibold text-gray-400 uppercase">{{ date('D, M d Y') }}</span>
                        </div>
                        <div class="p-0">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Time</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Customer / Service</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Barber</th>
                                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @forelse($todaysSchedule as $appt)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                                                        {{ \Carbon\Carbon::parse($appt->start_time)->format('h:i A') }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $appt->user->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $appt->service->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-600 dark:text-gray-300">{{ $appt->barber->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    @if($appt->status === 'pending')
                                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded text-[10px] font-bold uppercase">Pending</span>
                                                    @elseif($appt->status === 'confirmed')
                                                        <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold uppercase">Confirmed</span>
                                                    @elseif($appt->status === 'completed')
                                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-[10px] font-bold uppercase">Done</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">No appointments for today.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Links -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('barbers.create') }}" class="flex items-center p-3 rounded-lg border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded text-indigo-600 dark:text-indigo-400">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium dark:text-gray-300">Add New Barber</span>
                            </a>
                            <a href="{{ route('services.create') }}" class="flex items-center p-3 rounded-lg border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded text-green-600 dark:text-green-400">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium dark:text-gray-300">Add New Service</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-indigo-600 rounded-xl p-6 text-white shadow-lg overflow-hidden relative">
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-2">Grow your shop!</h3>
                            <p class="text-indigo-100 text-sm mb-4">You have {{ $totalBarbers }} active barbers and {{ $totalRevenue > 0 ? 'steady revenue' : 'a fresh start' }}.</p>
                            <a href="{{ route('admin.appointments.index') }}" class="inline-block px-4 py-2 bg-white text-indigo-600 rounded-lg text-sm font-bold hover:bg-indigo-50 transition">
                                Manage Bookings
                            </a>
                        </div>
                        <i class="fas fa-chart-line absolute bottom-[-20px] right-[-10px] text-8xl text-indigo-500/30"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
