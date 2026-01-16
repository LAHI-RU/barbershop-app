<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 uppercase tracking-tight italic">
                {{ __('Refine Artisan Profile') }}
            </h2>
            <a href="{{ route('barbers.index') }}" class="text-[10px] font-black text-gold hover:text-white uppercase tracking-[0.2em] transition">
                &larr; Return to Roster
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900/50 backdrop-blur-md overflow-hidden shadow-2xl shadow-black/20 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="p-10">
                    <form action="{{ route('barbers.update', $barber) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Artisan Name') }}</label>
                                <input id="name" type="text" name="name" value="{{ old('name', $barber->name) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" required autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Contact Number') }}</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone', $barber->phone) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" required />
                                <x-input-error for="phone" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Email Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $barber->email) }}" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300" />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="is_active" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Deployment Status') }}</label>
                                <select name="is_active" id="is_active" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300">
                                    <option value="1" class="bg-gray-900 text-white" {{ old('is_active', $barber->is_active) == 1 ? 'selected' : '' }}>Available for Duty</option>
                                    <option value="0" class="bg-gray-900 text-white" {{ old('is_active', $barber->is_active) == 0 ? 'selected' : '' }}>On Sabbatical</option>
                                </select>
                                <x-input-error for="is_active" class="mt-2" />
                            </div>

                            <!-- Bio -->
                            <div class="md:col-span-2">
                                <label for="bio" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Artisan Bio & Experience') }}</label>
                                <textarea name="bio" id="bio" rows="4" class="block w-full bg-black/50 border-gray-800 text-white rounded-xl focus:border-gold focus:ring-gold transition-all duration-300">{{ old('bio', $barber->bio) }}</textarea>
                                <x-input-error for="bio" class="mt-2" />
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-[10px] font-black text-gold uppercase tracking-[0.2em] mb-2">{{ __('Portfolio Portrait') }}</label>
                                <div class="mt-2 flex items-center space-x-8">
                                    <div class="flex-shrink-0 relative group">
                                        @if($barber->image_url)
                                            <img src="{{ Storage::url($barber->image_url) }}" alt="{{ $barber->name }}" class="h-32 w-32 object-cover rounded-2xl border-2 border-gold/20 shadow-xl group-hover:border-gold transition-colors duration-500">
                                            <div class="absolute -top-2 -right-2 bg-gold text-black text-[8px] font-black px-2 py-1 rounded-full uppercase tracking-tighter shadow-lg">Current</div>
                                        @else
                                            <div class="h-32 w-32 rounded-2xl bg-black/40 border-2 border-dashed border-gray-800 flex items-center justify-center text-gray-700">
                                                <i class="fas fa-camera text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input id="image" type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-gold file:text-black hover:file:bg-white transition-all cursor-pointer" />
                                        <p class="text-[10px] text-gray-500 mt-3 uppercase tracking-widest font-bold">Replace existing portrait? Select a new square format file (Max 2MB).</p>
                                    </div>
                                </div>
                                <x-input-error for="image" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-12 pt-8 border-t border-gray-800">
                            <a href="{{ route('barbers.index') }}" class="text-[10px] font-black text-gray-500 hover:text-white uppercase tracking-[0.2em] mr-8 transition">
                                {{ __('Discard Changes') }}
                            </a>
                            <button type="submit" class="px-8 py-4 bg-gold text-black rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white transition duration-300 shadow-xl shadow-gold/10">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
