<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Select Barber -->
                            <div>
                                <x-label for="barber_id" value="{{ __('Select Barber') }}" />
                                <select name="barber_id" id="barber_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Choose a Barber --</option>
                                    @foreach($barbers as $barber)
                                        <option value="{{ $barber->id }}" {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                            {{ $barber->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="barber_id" class="mt-2" />
                            </div>

                            <!-- Select Service -->
                            <div>
                                <x-label for="service_id" value="{{ __('Select Service') }}" />
                                <select name="service_id" id="service_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Choose a Service --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} (LKR {{ number_format($service->price, 0) }} - {{ $service->duration_minutes }} mins)
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="service_id" class="mt-2" />
                            </div>

                            <!-- Date -->
                            <div>
                                <x-label for="appointment_date" value="{{ __('Preferred Date') }}" />
                                <x-input id="appointment_date" class="block mt-1 w-full" type="date" name="appointment_date" :value="old('appointment_date', date('Y-m-d'))" min="{{ date('Y-m-d') }}" required />
                                <x-input-error for="appointment_date" class="mt-2" />
                            </div>

                            <!-- Time -->
                            <div>
                                <x-label for="start_time" value="{{ __('Preferred Time (e.g., 10:00)') }}" />
                                <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time')" required />
                                <p class="text-xs text-gray-500 mt-1">Shop hours: 9:00 AM - 7:00 PM</p>
                                <x-input-error for="start_time" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <x-label for="notes" value="{{ __('Special Requests (Optional)') }}" />
                                <textarea name="notes" id="notes" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Any specific requirements...">{{ old('notes') }}</textarea>
                                <x-input-error for="notes" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-button class="ml-4">
                                {{ __('Confirm Booking') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Shop Info Card -->
            <div class="mt-6 bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-lg border border-indigo-100 dark:border-indigo-800">
                <h3 class="text-indigo-800 dark:text-indigo-400 font-bold mb-2">Booking Information</h3>
                <ul class="text-sm text-indigo-700 dark:text-indigo-300 list-disc list-inside space-y-1">
                    <li>Your appointment will be reviewed by our team.</li>
                    <li>Please arrive 5 minutes before your scheduled time.</li>
                    <li>Cancellations should be made at least 2 hours in advance.</li>
                    <li>Prices are subject to change based on additional requirements.</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
