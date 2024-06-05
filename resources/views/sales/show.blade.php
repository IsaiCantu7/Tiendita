<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Show Sales</h2>
                    <a href="{{ route('sales.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                </div>

                <div>
                    <label for="id_product" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Product</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="id_product" name="id_product" value="{{ $sale->product->name }}" readonly>
                </div>

                <div>
                    <label for="id_category" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Category</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="id_category" name="id_category" value="{{ $sale->category->name }}" readonly>
                </div>

                <div>
                    <label for="id_customer" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Customer</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="id_customer" name="id_customer" value="{{ $sale->customer->first_name }} {{ $sale->customer->last_name }}" readonly>
                </div>

                <div>
                    <label for="date_sale" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Date Sale</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="date_sale" name="date_sale" value="{{ $sale->date_sale }}" readonly>
                </div>

                <div>
                    <label for="subtotal" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Subtotal</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="subtotal" name="subtotal" value="{{ $sale->subtotal }}" readonly>
                </div>

                <div>
                    <label for="iva" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">IVA</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="iva" name="iva" value="{{ $sale->iva }}" readonly>
                </div>

                <div>
                    <label for="total" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Total</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" id="total" name="total" value="{{ $sale->total }}" readonly>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
