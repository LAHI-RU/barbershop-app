<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barber Details') }}: {{ $barber->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="flex-shrink-0">
                            @if($barber->image_url)
                                <img src="{{ Storage::url($barber->image_url) }}" alt="{{ $barber->name }}" class="h-64 w-64 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="h-64 w-64 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user fa-5x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $barber->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4 whitespace-pre-line">{{ $barber->bio ?? 'No bio provided.' }}</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</h4>
                                    <p class="text-sm dark:text-gray-200">{{ $barber->email ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</h4>
                                    <p class="text-sm dark:text-gray-200">{{ $barber->phone }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</h4>
                                    <p class="text-sm">
                                        @if($barber->is_active)
                                            <span class="text-green-600 font-semibold">Active</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('barbers.index') }}" class="text-indigo-600 hover:text-indigo-900">
                                    &larr; Back to list
                                </a>
                                <a href="{{ route('barbers.edit', $barber) }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
