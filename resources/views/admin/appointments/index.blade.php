<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin: Appointment Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-100 dark:border-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    <th class="px-6 py-3">Date & Time</th>
                                    <th class="px-6 py-3">Customer</th>
                                    <th class="px-6 py-3">Barber</th>
                                    <th class="px-6 py-3">Service</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-right">Update Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($appointments as $appointment)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-75 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M d, Y') }}
                                            </div>
                                            <div class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold">
                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                                                {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $appointment->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $appointment->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-200 font-semibold">{{ $appointment->barber->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-200">{{ $appointment->service->name }}</div>
                                            <div class="text-xs text-gray-500">LKR {{ number_format($appointment->total_price, 0) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($appointment->status === 'pending')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-md text-[10px] font-bold uppercase shadow-sm">Pending</span>
                                            @elseif($appointment->status === 'confirmed')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase shadow-sm">Confirmed</span>
                                            @elseif($appointment->status === 'completed')
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-md text-[10px] font-bold uppercase shadow-sm">Completed</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-md text-[10px] font-bold uppercase shadow-sm">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST" class="inline-flex gap-1">
                                                @csrf
                                                @method('PATCH')
                                                @if($appointment->status === 'pending')
                                                    <button name="status" value="confirmed" class="p-1.5 bg-green-500 text-white rounded hover:bg-green-600 transition" title="Confirm">
                                                        <i class="fas fa-check text-xs"></i>
                                                    </button>
                                                @endif
                                                @if($appointment->status === 'confirmed')
                                                    <button name="status" value="completed" class="p-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 transition" title="Complete">
                                                        <i class="fas fa-flag-checkered text-xs"></i>
                                                    </button>
                                                @endif
                                                @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
                                                    <button name="status" value="cancelled" class="p-1.5 bg-red-500 text-white rounded hover:bg-red-600 transition" title="Cancel">
                                                        <i class="fas fa-times text-xs"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                            No appointments scheduled yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
