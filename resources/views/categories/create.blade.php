<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{('Add New Category') }}
        </h2>
    </x-slot>

    @vite('resources/css/app.css')
    <div class="flex justify-center mt-8">
        <div class="w-full md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add New Category</h2>
                    <a href="{{ route('categories.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md flex items-center"><i class="bi bi-arrow-left mr-1"></i> Back</a>
                </div>
                
                <form action="{{ route('categories.store') }}" method="post" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter the category name" required>
                        @error('name')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-md font-semibold text-gray-700 dark:text-gray-300 mb-1">Descripcion</label>
                        <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 placeholder-gray-500 @error('description') border-red-500 @enderror" id="description" name="description" placeholder="Enter the category description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div>
                        <input type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md cursor-pointer" value="Add Category">
                    </div>
                </form>
            </div>
        </div>    
    </div>
</x-app-layout>
