<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">Edit City</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-10">Update the details of the city below.</p>

                    @if(session('success'))
                        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-4 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" class="text-gray-800 dark:text-gray-100" />
                                <x-text-input id="name" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" type="text" name="name" :value="old('name', $city->name)" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Country -->
                            <div>
                                <x-input-label for="country" :value="__('Country')" class="text-gray-800 dark:text-gray-100" />
                                <x-text-input id="country" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" type="text" name="country" :value="old('country', $city->country)" required />
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>

                            <!-- Timezone -->
                            <div>
                                <x-input-label for="timezone" :value="__('Timezone')" class="text-gray-800 dark:text-gray-100" />
                                <select id="timezone" name="timezone" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" required>
                                    @foreach(timezone_identifiers_list() as $tz)
                                        <option value="{{ $tz }}" {{ old('timezone', $city->timezone) == $tz ? 'selected' : '' }}>{{ $tz }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('timezone')" class="mt-2" />
                            </div>

                            <!-- Temperature -->
                            <div>
                                <x-input-label for="temperature" :value="__('Temperature')" class="text-gray-800 dark:text-gray-100" />
                                <x-text-input id="temperature" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" type="number" step="0.1" min="-50" max="60" name="temperature" :value="old('temperature', $city->temperature)" required />
                                <x-input-error :messages="$errors->get('temperature')" class="mt-2" />
                            </div>

                            <!-- Submit -->
                            <div class="text-end">
                                <x-primary-button>
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>