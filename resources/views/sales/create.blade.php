<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Venta') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <div class="text-center text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        {{ __('Crear nueva venta') }}
                    </div>
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name_product" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Producto</label>
                            <select name="name_product" id="name_product" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                                <option value="">Seleccionar Producto</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->name }}" data-category="{{ $product->category->name }}" data-sale-price="{{ $product->sale_price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="name_category" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                            <input type="text" name="name_category" id="name_category" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="name_customer" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Cliente</label>
                            <select name="name_customer" id="name_customer" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
                                <option value="">Seleccionar Cliente</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->first_name }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date_sale" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Date Sale') }}</label>
                            <input type="date" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('date_sale') border-red-500 @enderror" id="date_sale" name="date_sale" value="{{ old('date_sale') }}">
                            @error('date_sale')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="subtotal" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Subtotal') }}</label>
                            <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('subtotal') border-red-500 @enderror" id="subtotal" name="subtotal" value="{{ old('subtotal') }}" readonly>
                            @error('subtotal')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="iva" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('IVA') }}</label>
                            <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('iva') border-red-500 @enderror" id="iva" name="iva" value="{{ old('iva') }}" readonly>
                            @error('iva')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="total" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">{{ __('Total') }}</label>
                            <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('total') border-red-500 @enderror" id="total" name="total" value="{{ old('total') }}" readonly>
                            @error('total')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="motivo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Motivo</label>
                            <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo" placeholder="Ingrese el motivo">{{ old('motivo') }}</textarea>
                            @error('motivo')
                                <span class="text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="{{ __('Create Sale') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('name_product');
            const categoryInput = document.getElementById('name_category');
            const subtotalInput = document.getElementById('subtotal');
            const ivaInput = document.getElementById('iva');
            const totalInput = document.getElementById('total');

            productSelect.addEventListener('change', function() {
                const selectedProduct = this.options[this.selectedIndex];
                const categoryName = selectedProduct.getAttribute('data-category');
                const salePrice = parseFloat(selectedProduct.getAttribute('data-sale-price'));

                categoryInput.value = categoryName;

                if (!isNaN(salePrice)) {
                    const iva = salePrice * 0.16;
                    const subtotal = salePrice - iva;

                    subtotalInput.value = subtotal.toFixed(2);
                    ivaInput.value = iva.toFixed(2);
                    totalInput.value = salePrice.toFixed(2);
                } else {
                    subtotalInput.value = '';
                    ivaInput.value = '';
                    totalInput.value = '';
                }
            });
        });
    </script>
</x-app-layout>
