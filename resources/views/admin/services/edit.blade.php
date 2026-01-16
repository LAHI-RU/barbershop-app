<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight italic">
                {{ __('Refine Offering') }}
            </h2>
            <a href="{{ route('services.index') }}" class="text-[10px] font-black text-gold hover:text-white uppercase tracking-[0.2em] transition">
                &larr; Return to Menu
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/20 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="p-10">
                    <form action="{{ route('services.update', $service) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Service Name') }}</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $service->name) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" required autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Service Category') }}</label>
                                <select name="category" id="category" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300">
                                    <option value="Haircut" class="bg-gray-900" {{ old('category', $service->category) == 'Haircut' ? 'selected' : '' }}>Haircut</option>
                                    <option value="Shave" class="bg-gray-900" {{ old('category', $service->category) == 'Shave' ? 'selected' : '' }}>Shave</option>
                                    <option value="Beard Trim" class="bg-gray-900" {{ old('category', $service->category) == 'Beard Trim' ? 'selected' : '' }}>Beard Trim</option>
                                    <option value="Facial" class="bg-gray-900" {{ old('category', $service->category) == 'Facial' ? 'selected' : '' }}>Facial</option>
                                    <option value="Other" class="bg-gray-900" {{ old('category', $service->category) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error for="category" class="mt-2" />
                            </div>

                            <!-- Duration -->
                            <div>
                                <label for="duration_minutes" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Duration (Minutes)') }}</label>
                                <input id="duration_minutes" type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" required />
                                <x-input-error for="duration_minutes" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Investment (LKR)') }}</label>
                                <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" required />
                                <x-input-error for="price" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div class="flex items-center pt-8">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gold"></div>
                                    <span class="ml-3 text-[10px] font-black text-gold uppercase tracking-[0.2em]">{{ __('Available Now') }}</span>
                                </label>
                                <x-input-error for="is_active" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Offering Narrative') }}</label>
                                <textarea name="description" id="description" rows="3" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300">{{ old('description', $service->description) }}</textarea>
                                <x-input-error for="description" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-12 pt-8 border-t border-gray-800">
                            <a href="{{ route('services.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white uppercase tracking-[0.2em] mr-8 transition">
                                {{ __('Discard Changes') }}
                            </a>
                            <button type="submit" class="px-8 py-4 bg-gold text-black rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white transition duration-300 shadow-xl shadow-gold/10">
                                {{ __('Update Offering') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
