<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Show Customer</h2>
                    <a href="{{ route('customers.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                </div>

                <div>
                    <label for="first_name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="first_name" name="first_name" value="{{ $customer->first_name }}" readonly>
                </div>

                <div>
                    <label for="last_name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="last_name" name="last_name" value="{{ $customer->last_name }}" readonly>
                </div>

                <div>
                    <label for="email" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="email" name="email" value="{{ $customer->email }}" readonly>
                </div>

                <div>
                    <label for="phone" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="phone" name="phone" value="{{ $customer->phone }}" readonly>
                </div>

                <div>
                    <label for="address" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Address</label>
                    <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="address" name="address" readonly>{{ $customer->address }}</textarea>
                </div>

                <div>
                    <label for="rfc" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">RFC</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="rfc" name="rfc" value="{{ $customer->rfc }}" readonly>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
