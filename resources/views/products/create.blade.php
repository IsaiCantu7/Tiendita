<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    @vite('resources/css/app.css')
    <div class="flex justify-center mt-8">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add New Product</h2>
                    <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                </div>
                
                <form action="{{ route('products.store') }}" method="post" class="space-y-4">
                    @csrf

                    <div>
                        <label for="code" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Código</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('code') border-red-500 @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="Ingrese el código del producto" required>
                        @error('code')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre del producto" required>
                        @error('name')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="quantity" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Cantidad</label>
                        <input type="number" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('quantity') border-red-500 @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Ingrese la cantidad" required>
                        @error('quantity')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="purchase_price" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Precio de Compra</label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('purchase_price') border-red-500 @enderror" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" placeholder="Ingrese el precio de compra" required>
                        @error('purchase_price')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="sale_price" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Precio de Venta</label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('sale_price') border-red-500 @enderror" id="sale_price" name="sale_price" value="{{ old('sale_price') }}" placeholder="Ingrese el precio de venta" required>
                        @error('sale_price')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="motivo" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Motivo</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('motivo') border-red-500 @enderror" id="motivo" name="motivo" value="{{ old('motivo') }}" placeholder="Ingrese el motivo" required>
                        @error('motivo')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description_short" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Descripción Corta</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('description_short') border-red-500 @enderror" id="description_short" name="description_short" placeholder="Ingrese una descripción corta">{{ old('description_short') }}</textarea>
                        @error('description_short')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description_large" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Descripción Larga</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('description_large') border-red-500 @enderror" id="description_large" name="description_large" placeholder="Ingrese una descripción larga">{{ old('description_large') }}</textarea>
                        @error('description_large')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="colors" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Colores</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('colors') border-red-500 @enderror" id="colors" name="colors" value="{{ old('colors') }}" placeholder="Ingrese los colores disponibles">
                        @error('colors')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                        <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
                            <option value="">Seleccionar Categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="Agregar Producto">
                    </div>
                </form>
            </div>
        </div>    
    </div>
</x-app-layout>
