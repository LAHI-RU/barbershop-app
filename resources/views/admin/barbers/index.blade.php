<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight uppercase tracking-tight">
                {{ __('Artisan Roster') }}
            </h2>
            <a href="{{ route('barbers.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-500/20">
                <i class="fas fa-plus mr-2 text-[10px]"></i> {{ __('Onboard New Artisan') }}
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

            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-900/80">
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Master</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Contact Information</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Availability</th>
                                    <th class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                                @forelse($barbers as $barber)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-14 w-14">
                                                    @if($barber->image_url)
                                                        <img src="{{ Storage::url($barber->image_url) }}" alt="{{ $barber->name }}" class="h-14 w-14 rounded-2xl object-cover border-2 border-indigo-50 dark:border-indigo-900/30">
                                                    @else
                                                        <div class="h-14 w-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                                                            <i class="fas fa-user text-xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $barber->name }}</div>
                                                    <div class="text-xs text-gray-500 font-medium">{{ Str::limit($barber->bio, 40) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <div class="inline-flex items-center text-sm text-gray-900 dark:text-gray-200 font-bold mb-1">
                                                    <i class="fas fa-phone-alt mr-2 text-[10px] text-gray-400"></i>
                                                    {{ $barber->phone }}
                                                </div>
                                                <div class="inline-flex items-center text-xs text-gray-500 font-medium">
                                                    <i class="fas fa-envelope mr-2 text-[10px] text-gray-400"></i>
                                                    {{ $barber->email }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($barber->is_active)
                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mr-2"></span> Off-Duty
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right text-sm">
                                            <div class="flex justify-end space-x-3">
                                                <a href="{{ route('barbers.edit', $barber) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="Edit Artisan">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('barbers.destroy', $barber) }}" method="POST" class="inline" onsubmit="return confirm('Archive this artisan profile?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition-colors" title="Remove Artisan">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-24 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                                                    <i class="fas fa-users-slash text-gray-200 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-bold text-lg mb-4">No master artisans found.</p>
                                                <a href="{{ route('barbers.create') }}" class="text-indigo-600 font-black uppercase tracking-widest text-xs hover:underline">Start Onboarding →</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($barbers->hasPages())
                <div class="mt-8 px-4">
                    {{ $barbers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
