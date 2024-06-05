<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="first_name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombres</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}" placeholder="Enter first name">
                        @error('first_name')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Apellidos</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}" placeholder="Enter last name">
                        @error('last_name')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Correo</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror" value="{{ old('email') }}" placeholder="Enter email">
                        @error('email')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Telefono</label>
                        <input type="number" id="phone" name="phone" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('phone') border-red-500 @enderror" value="{{ old('phone') }}" placeholder="Enter phone">
                        @error('phone')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Dirección</label>
                        <input type="text" id="address" name="address" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('address') border-red-500 @enderror" value="{{ old('address') }}" placeholder="Enter address">
                        @error('address')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="rfc" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">RFC</label>
                        <input type="text" id="rfc" name="rfc" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('rfc') border-red-500 @enderror" value="{{ old('rfc') }}" placeholder="Enter RFC">
                        @error('rfc')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="button" onclick="window.location='{{ route('customers.index') }}';" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{('Regresar a la lista') }}</button>

                        <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
