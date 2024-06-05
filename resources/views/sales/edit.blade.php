<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Venta') }}
        </h2>

        <a href="{{ route('sales.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Regresar</a>

    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form method="POST" action="{{ route('sales.update', $sale->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- ID del Producto -->
                        <div class="mb-4">
                            <label for="name_product" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('ID del Producto') }}</label>
                            <select id="name_product" class="block mt-1 w-full" name="name_product" required autofocus>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if ($sale->name_product == $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ID de la Categoría -->
                        <div class="mb-4">
                            <label for="name_category" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('ID de la Categoría') }}</label>
                            <select id="name_category" class="block mt-1 w-full" name="name_category" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($sale->name_category == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ID del Cliente -->
                        <div class="mb-4">
                            <label for="name_customer" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('ID del Cliente') }}</label>
                            <select id="name_customer" class="block mt-1 w-full" name="name_customer" required>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" @if ($sale->name_customer == $customer->id) selected @endif>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha de Venta -->
                        <div class="mb-4">
                            <label for="date_sale" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Fecha de Venta') }}</label>
                            <input id="date_sale" class="block mt-1 w-full" type="date" name="date_sale" value="{{ old('date_sale', $sale->date_sale) }}" required />
                        </div>

                        <!-- Subtotal -->
                        <div class="mb-4">
                            <label for="subtotal" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Subtotal') }}</label>
                            <input id="subtotal" class="block mt-1 w-full" type="number" name="subtotal" value="{{ old('subtotal', $sale->subtotal) }}" required />
                        </div>

                        <!-- IVA -->
                        <div class="mb-4">
                            <label for="iva" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('IVA') }}</label>
                            <input id="iva" class="block mt-1 w-full" type="number" name="iva" value="{{ old('iva', $sale->iva) }}" required />
                        </div>

                        <!-- Total -->
                        <div class="mb-4">
                            <label for="total" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Total') }}</label>
                            <input id="total" class="block mt-1 w-full" type="number" name="total" value="{{ old('total', $sale->total) }}" required />
                        </div>

                        <!-- Motivo -->
                        <div class="mb-4">
                            <label for="motivo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Motivo') }}</label>
                            <input id="motivo" class="block mt-1 w-full" type="text" name="motivo" value="{{ old('motivo', $sale->motivo) }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">{{ ('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
