<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Crear Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('inventories.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="id_product" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Producto') }}</label>
                            <select id="id_product" name="id_product" class="block mt-1 w-full text-black">
                                <option value="">{{ ('Seleccione un producto') }}</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="id_category" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Categoría') }}</label>
                            <select id="id_category" name="id_category" class="block mt-1 w-full text-black">
                                <option value="">{{ ('Seleccione una categoría') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="entry_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Fecha de Entrada') }}</label>
                            <input id="entry_date" class="block mt-1 w-full text-black" type="date" name="entry_date" value="{{ old('entry_date') }}" />
                        </div>

                        <div class="mb-4">
                            <label for="departure_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Fecha de Salida') }}</label>
                            <input id="departure_date" class="block mt-1 w-full text-black" type="date" name="departure_date" value="{{ old('departure_date') }}" />
                        </div>

                        <div class="mb-4">
                            <label for="reason" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Motivo') }}</label>
                            <input id="reason" class="block mt-1 w-full text-black" type="text" name="reason" value="{{ old('reason') }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="shift" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Razon') }}</label>
                            <input id="shift" class="block mt-1 w-full text-black" type="text" name="shift" value="{{ old('shift') }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ ('Cantidad') }}</label>
                            <input id="quantity" class="block mt-1 w-full text-black" type="number" name="quantity" value="{{ old('quantity') }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                {{ ('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
