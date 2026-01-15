<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight">
                {{ __('Booking Management') }}
            </h2>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full border border-gray-200 dark:border-gray-700">
                <i class="fas fa-calendar-check text-indigo-500 mr-2"></i> Master Schedule
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-900/80">
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Appointment Slot</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Client Details</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Assigned Artisan</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Service & Price</th>
                                    <th class="px-8 py-5 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Workflow</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                                @forelse($appointments as $appointment)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-tight">
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M d') }}
                                            </div>
                                            <div class="text-[10px] text-indigo-600 dark:text-indigo-400 font-black uppercase tracking-widest mt-1">
                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-200">{{ $appointment->user->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-medium uppercase tracking-wider">{{ $appointment->user->email }}</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-user-tie text-[10px] text-gray-500"></i>
                                                </div>
                                                <span class="text-sm font-bold text-gray-600 dark:text-gray-300">{{ $appointment->barber->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-200">{{ $appointment->service->name }}</div>
                                            <div class="text-[10px] text-emerald-600 font-black uppercase tracking-widest mt-1">LKR {{ number_format($appointment->total_price, 0) }}</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-center">
                                            @if($appointment->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Pending</span>
                                            @elseif($appointment->status === 'confirmed')
                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Confirmed</span>
                                            @elseif($appointment->status === 'completed')
                                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Completed</span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right">
                                            <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST" class="inline-flex gap-2">
                                                @csrf
                                                @method('PATCH')
                                                @if($appointment->status === 'pending')
                                                    <button name="status" value="confirmed" class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all duration-300 border border-emerald-100 dark:border-emerald-900 shadow-sm" title="Confirm Booking">
                                                        <i class="fas fa-check text-xs"></i>
                                                    </button>
                                                @endif
                                                @if($appointment->status === 'confirmed')
                                                    <button name="status" value="completed" class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition-all duration-300 border border-indigo-100 dark:border-indigo-900 shadow-sm" title="Mark Completed">
                                                        <i class="fas fa-flag-checkered text-xs"></i>
                                                    </button>
                                                @endif
                                                @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
                                                    <button name="status" value="cancelled" class="w-8 h-8 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition-all duration-300 border border-rose-100 dark:border-rose-900 shadow-sm" title="Cancel Booking">
                                                        <i class="fas fa-times text-xs"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-8 py-24 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                                                    <i class="fas fa-calendar-alt text-gray-200 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-bold text-lg">No appointments in the queue.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($appointments->hasPages())
                <div class="mt-8 px-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
