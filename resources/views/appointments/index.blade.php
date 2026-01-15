<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Appointments') }}
            </h2>
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Book New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @forelse($appointments as $appointment)
                        <div class="mb-6 last:mb-0 border-b last:border-0 pb-6 last:pb-0 border-gray-100 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-100 dark:bg-indigo-900/40 p-3 rounded-lg flex flex-col items-center justify-center min-w-[80px]">
                                    <span class="text-xs uppercase font-bold text-indigo-600 dark:text-indigo-400">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M') }}</span>
                                    <span class="text-2xl font-black text-indigo-900 dark:text-white">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d') }}</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $appointment->service->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">with <span class="font-semibold">{{ $appointment->barber->name }}</span></p>
                                    <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-coins"></i> LKR {{ number_format($appointment->total_price, 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between md:justify-end gap-6 text-right">
                                <div>
                                    <span class="text-xs uppercase font-bold text-gray-400 block mb-1">Status</span>
                                    @if($appointment->status === 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase">Pending</span>
                                    @elseif($appointment->status === 'confirmed')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase">Confirmed</span>
                                    @elseif($appointment->status === 'completed')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold uppercase">Completed</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase">Cancelled</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="text-gray-300 dark:text-gray-600 mb-4">
                                <i class="fas fa-calendar-times fa-4x"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">No appointments found</h3>
                            <p class="text-gray-500 mt-2">Ready for a fresh look? Book your first session now!</p>
                            <div class="mt-6">
                                <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
