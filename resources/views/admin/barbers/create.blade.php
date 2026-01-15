<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($barber) ? __('Edit Barber') : __('Add New Barber') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ isset($barber) ? route('barbers.update', $barber) : route('barbers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($barber))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $barber->name ?? '')" required autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <x-label for="phone" value="{{ __('Phone Number') }}" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $barber->phone ?? '')" required />
                                <x-input-error for="phone" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-label for="email" value="{{ __('Email (Optional)') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $barber->email ?? '')" />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-label for="is_active" value="{{ __('Account Status') }}" />
                                <select name="is_active" id="is_active" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="1" {{ old('is_active', $barber->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $barber->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <x-input-error for="is_active" class="mt-2" />
                            </div>

                            <!-- Bio -->
                            <div class="md:col-span-2">
                                <x-label for="bio" value="{{ __('Bio / Experience') }}" />
                                <textarea name="bio" id="bio" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('bio', $barber->bio ?? '') }}</textarea>
                                <x-input-error for="bio" class="mt-2" />
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <x-label for="image" value="{{ __('Profile Image') }}" />
                                @if(isset($barber) && $barber->image_url)
                                    <div class="mt-2 mb-4">
                                        <img src="{{ Storage::url($barber->image_url) }}" alt="{{ $barber->name }}" class="h-32 w-32 object-cover rounded shadow-md border">
                                        <p class="text-xs text-gray-500 mt-1">Current Image</p>
                                    </div>
                                @endif
                                <input id="image" type="file" name="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                                <x-input-error for="image" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('barbers.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-button>
                                {{ isset($barber) ? __('Update Barber') : __('Add Barber') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
