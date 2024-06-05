<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class InventoriesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el valor de la búsqueda
        $query = $request->input('query');

        $inventories = Inventories::with(['product', 'category'])->paginate(10);

        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                               ->orWhere('description_short', 'LIKE', "%{$query}%")
                               ->orWhere('description_large', 'LIKE', "%{$query}%")
                               ->get();

            $sales = Sales::where('name_product', 'LIKE', "%{$query}%")
                          ->orWhere('name_category', 'LIKE', "%{$query}%")
                          ->orWhere('name_customer', 'LIKE', "%{$query}%")
                          ->get();
        } else {
            $products = Product::all();
            $sales = Sales::with(['product', 'category', 'customer'])->get();
        }

        return view('inventories.index', compact('inventories', 'products', 'sales', 'query'));
    }

    // Método para mostrar el formulario de creación de un nuevo inventario
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('inventories.create', compact('products', 'categories'));
    }
    // Método para almacenar un nuevo inventario
    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'id_category' => 'required|exists:categories,id',
            'entry_date' => 'required|date',
            'departure_date' => 'nullable|date',
            'reason' => 'required|string',
            'shift' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        Inventories::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventario creado exitosamente.');
    }

    // Método para mostrar un inventario
    public function show(Inventories $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    public function edit(Inventories $inventory)
    {
        $products = Product::all();
        $categories = Category::all();
        return view('inventories.edit', compact('inventory', 'products', 'categories'));
    }

    // Método para actualizar un inventario
    public function update(Request $request, Inventories $inventory)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'id_category' => 'required|exists:categories,id',
            'entry_date' => 'required|date',
            'departure_date' => 'nullable|date',
            'reason' => 'required|string',
            'shift' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventories.index')->with('success', 'Inventario actualizado exitosamente.');
    }

    // Método para eliminar un inventario
    public function destroy(Inventories $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Inventario eliminado exitosamente.');
    }

    // Método para reducir la cantidad de inventario después de una venta
    public function reduceInventory($productId, $quantity)
    {
        $inventory = Inventories::where('id_product', $productId)->first();

        if ($inventory && $inventory->quantity >= $quantity) {
            $inventory->quantity -= $quantity;
            $inventory->save();
            return true;
        }

        return false;
    }
}
