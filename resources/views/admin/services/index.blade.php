<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight uppercase tracking-tight">
                {{ __('Service Menu') }}
            </h2>
            <a href="{{ route('services.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-[0.2em] hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-500/20">
                <i class="fas fa-plus mr-2 text-[10px]"></i> {{ __('Add New Offering') }}
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
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Service Name</th>
                                    <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Type</th>
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
                                            <div class="text-xs text-gray-400 font-medium">{{ Str::limit($service->description, 60) }}</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                {{ $service->category ?? 'General' }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-black text-gray-900 dark:text-white">LKR {{ number_format($service->price, 0) }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider flex items-center">
                                                <i class="far fa-clock mr-1 text-gold"></i> {{ $service->duration_minutes }} Minutes
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @if($service->is_active)
                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mr-2"></span> Retired
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right text-sm">
                                            <div class="flex justify-end space-x-3">
                                                <a href="{{ route('services.edit', $service) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="Edit Service">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Remove this service from the menu?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition-colors" title="Remove Service">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-24 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                                                    <i class="fas fa-concierge-bell text-gray-200 text-3xl"></i>
                                                </div>
                                                <p class="text-gray-500 font-bold text-lg mb-4">Your service menu is empty.</p>
                                                <a href="{{ route('services.create') }}" class="text-indigo-600 font-black uppercase tracking-widest text-xs hover:underline">Create First Service →</a>
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
                <div class="mt-8 px-4">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
