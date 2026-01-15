<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($service) ? __('Edit Service') : __('Add New Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}" method="POST">
                        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <x-label for="name" value="{{ __('Service Name') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $service->name ?? '')" required autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-label for="category" value="{{ __('Category') }}" />
                                <select name="category" id="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Haircut" {{ old('category', $service->category ?? '') == 'Haircut' ? 'selected' : '' }}>Haircut</option>
                                    <option value="Shave" {{ old('category', $service->category ?? '') == 'Shave' ? 'selected' : '' }}>Shave</option>
                                    <option value="Beard Trim" {{ old('category', $service->category ?? '') == 'Beard Trim' ? 'selected' : '' }}>Beard Trim</option>
                                    <option value="Facial" {{ old('category', $service->category ?? '') == 'Facial' ? 'selected' : '' }}>Facial</option>
                                    <option value="Other" {{ old('category', $service->category ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error for="category" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div>
                                <x-label for="price" value="{{ __('Price (LKR)') }}" />
                                <x-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $service->price ?? '')" required />
                                <x-input-error for="price" class="mt-2" />
                            </div>

                            <!-- Duration -->
                            <div>
                                <x-label for="duration_minutes" value="{{ __('Duration (Minutes)') }}" />
                                <x-input id="duration_minutes" class="block mt-1 w-full" type="number" name="duration_minutes" :value="old('duration_minutes', $service->duration_minutes ?? '')" required />
                                <x-input-error for="duration_minutes" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <x-label for="description" value="{{ __('Description') }}" />
                                <textarea name="description" id="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $service->description ?? '') }}</textarea>
                                <x-input-error for="description" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-label for="is_active" value="{{ __('Status') }}" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? 1) ? 'checked' : '' }} class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active') }}</span>
                                    </label>
                                </div>
                                <x-input-error for="is_active" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('services.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-button>
                                {{ isset($service) ? __('Update Service') : __('Add Service') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
