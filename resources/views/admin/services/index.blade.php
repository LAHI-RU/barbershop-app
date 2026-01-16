<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight italic">
                {{ __('Service Menu') }}
            </h2>
            <a href="{{ route('services.create') }}" class="inline-flex items-center px-6 py-3 bg-gold text-black rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white transition duration-300 shadow-xl shadow-gold/10">
                <i class="fas fa-plus mr-2 text-[10px]"></i> {{ __('Add New Offering') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-8 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex items-center text-emerald-500 shadow-lg">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span class="text-sm font-black uppercase tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/5 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                            <thead>
                                <tr class="bg-black/20 dark:bg-black/40">
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Service</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Category</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Economics</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                                @forelse($services as $service)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $service->name }}</div>
                                            <div class="text-[11px] text-gray-500 font-medium mt-1">{{ Str::limit($service->description, 65) }}</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 bg-gold/5 text-gold border border-gold/10 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                {{ $service->category ?? 'General' }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-black text-gray-900 dark:text-white italic tracking-tighter">LKR {{ number_format($service->price, 0) }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 flex items-center">
                                                <i class="far fa-clock mr-2 text-gold/60"></i> {{ $service->duration_minutes }} MIN
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($service->is_active)
                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-rose-500/10 text-rose-500 rounded-lg text-[10px] font-black uppercase tracking-widest border border-rose-500/20">
                                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mr-2"></span> Retired
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('services.edit', $service) }}" class="w-9 h-9 bg-gold/5 text-gold rounded-xl hover:bg-gold hover:text-black transition-all duration-300 border border-gold/20 shadow-lg flex items-center justify-center group/btn" title="Refine Offering">
                                                    <i class="fas fa-edit text-xs group-hover/btn:scale-110 transition-transform"></i>
                                                </a>
                                                <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline" onsubmit="event.preventDefault(); confirmElite('Are you certain you wish to retire this exclusive offering from the menu? This action cannot be undone.', this);">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-9 h-9 bg-rose-500/10 text-rose-500 rounded-xl hover:bg-rose-500 hover:text-black transition-all duration-300 border border-rose-500/20 shadow-lg flex items-center justify-center group/btn" title="Remove Offering">
                                                        <i class="fas fa-trash-alt text-xs group-hover/btn:scale-110 transition-transform"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-24 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-20 h-20 bg-black/40 rounded-full flex items-center justify-center mb-6 border border-gold/10">
                                                    <i class="fas fa-concierge-bell text-gold/20 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-black uppercase tracking-tight text-lg mb-4 italic">Your luxury service menu is empty.</p>
                                                <a href="{{ route('services.create') }}" class="text-gold font-black uppercase tracking-[0.2em] text-[10px] hover:text-white transition decoration-gold underline underline-offset-8">Create First Offering →</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($services->hasPages())
                <div class="mt-8">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
