<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Método para mostrar la lista de categorías
    public function index()
    {
        $categories = Category::paginate(10);  // Obtener todas las categorías de la base de datos

        return view('categories.index', compact('categories')); // Devolver la vista de lista de categorías con las categorías obtenidas
    }

    // Método para mostrar el formulario de creación de una nueva categoría
    public function create()
    {
        return view('categories.create'); // Devolver la vista de creación de categoría
    }

    // Método para almacenar una nueva categoría en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'description' => 'nullable|string', 
        ]);

        Category::create($request->all()); // Crear una nueva categoría con los datos recibidos

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.'); 
    }

    // Método para mostrar los detalles de una categoría específica
    public function show(Category $category)
    {
        return view('categories.show', compact('category')); 
    }

    // Método para mostrar el formulario de edición de una categoría
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Encontrar la categoría específica por su ID
        return view('categories.edit', compact('category')); // Devolver la vista de edición de categoría con la categoría específica
    }
    

    // Método para actualizar una categoría en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        //Actualizar la categoría
        $category = Category::findOrFail($id); 
        $category->name = $request->input('name'); 
        $category->description = $request->input('description'); 
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.'); 
    }

    // Método para eliminar una categoría de la base de datos
    public function destroy(Category $category)
    {
        $category->delete(); // Eliminar la categoría

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.'); 
    }
    
}