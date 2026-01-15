<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Service Details') }}: {{ $service->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="max-w-3xl">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $service->name }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                                <h4 class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-1">Price</h4>
                                <p class="text-xl font-bold text-indigo-900 dark:text-white">LKR {{ number_format($service->price, 2) }}</p>
                            </div>
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <h4 class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-1">Duration</h4>
                                <p class="text-xl font-bold text-blue-900 dark:text-white">{{ $service->duration_minutes }} mins</p>
                            </div>
                            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <h4 class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider mb-1">Category</h4>
                                <p class="text-xl font-bold text-purple-900 dark:text-white">{{ $service->category ?? 'General' }}</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Description</h4>
                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line leading-relaxed">
                                {{ $service->description ?? 'No description provided for this service.' }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-grow">
                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status</h4>
                                <p class="flex items-center">
                                    @if($service->is_active)
                                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                        <span class="text-green-600 font-semibold">Currently Active</span>
                                    @else
                                        <span class="h-2 w-2 rounded-full bg-red-500 mr-2"></span>
                                        <span class="text-red-600 font-semibold">Currently Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('services.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                                &larr; Back to Services List
                            </a>
                            <a href="{{ route('services.edit', $service) }}" class="ml-6 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white active:bg-gray-900 dark:active:bg-gray-300 transition ease-in-out duration-150">
                                Edit Service
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
