<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Barbers') }}
            </h2>
            <a href="{{ route('barbers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add New Barber') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="px-6 py-3">Photo</th>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Contact</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($barbers as $barber)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($barber->image_url)
                                                <img src="{{ Storage::url($barber->image_url) }}" alt="{{ $barber->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-indigo-200">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $barber->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($barber->bio, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-200">{{ $barber->phone }}</div>
                                            <div class="text-xs text-gray-500">{{ $barber->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($barber->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('barbers.edit', $barber) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('barbers.destroy', $barber) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this barber?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            No barbers found. <a href="{{ route('barbers.create') }}" class="text-indigo-600">Add one now</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $barbers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
