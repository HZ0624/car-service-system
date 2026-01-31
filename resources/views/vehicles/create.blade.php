<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form points to the 'store' route we defined in web.php -->
                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf

                        <!-- License Plate Input -->
                        <div>
                            <x-input-label for="license_plate" :value="__('License Plate')" />
                            <x-text-input id="license_plate" class="block mt-1 w-full" type="text" name="license_plate" :value="old('license_plate')" required autofocus />
                            <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                        </div>

                        <!-- Make Input (e.g., Toyota) -->
                        <div class="mt-4">
                            <x-input-label for="make" :value="__('Make (e.g. Toyota)')" />
                            <x-text-input id="make" class="block mt-1 w-full" type="text" name="make" :value="old('make')" required />
                            <x-input-error :messages="$errors->get('make')" class="mt-2" />
                        </div>

                        <!-- Model Input (e.g., Camry) -->
                        <div class="mt-4">
                            <x-input-label for="model" :value="__('Model (e.g. Camry)')" />
                            <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" required />
                            <x-input-error :messages="$errors->get('model')" class="mt-2" />
                        </div>

                        <!-- Year Input -->
                        <div class="mt-4">
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" required />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Save Vehicle') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>