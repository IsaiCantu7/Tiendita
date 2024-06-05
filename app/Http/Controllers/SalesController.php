<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    // Método para mostrar la lista de ventas
    public function index()
    {
        $sales = Sales::with(['product', 'category', 'customer'])->paginate(10);
        return view('sales.index', compact('sales'));
    }
    // Método para mostrar el formulario de creación de una nueva venta
    public function create()
    {
        // Obtener todos los productos, categorías y clientes
        $products = Product::all();
        $categories = Category::all();
        $customers = Customer::all();
        return view('sales.create', compact('products', 'categories', 'customers'));
    }


public function store(Request $request)
{
    // dd($request->all());
    // Validar los datos del formulario
    $request->validate([
        'name_product' => 'required|string',
        'name_category' => 'required|string',
        'name_customer' => 'required|string',
        'date_sale' => 'required|date',
        'subtotal' => 'required|numeric',
        'iva' => 'required|numeric',
        'total' => 'required|numeric',
        'motivo' => 'required|string',
    ]);



    // Iniciar la transacción
    DB::beginTransaction();

    try {
        // Buscar el producto por su nombre
        $product = Product::where('name', $request->name_product)->first();
        if (!$product) {
            throw new \Exception('Producto no encontrado.');
        }

        // Buscar la categoría por su nombre
        $category = Category::where('name', $request->name_category)->first();
        if (!$category) {
            throw new \Exception('Categoría no encontrada.');
        }

        // Buscar el cliente por su nombre
        $customer = Customer::where('first_name', $request->name_customer)->first();
        if (!$customer) {
            throw new \Exception('Cliente no encontrado.');
        }
        // Crear la venta
        Sales::create($request->all());


        // Disminuir la cantidad del producto
        $product->quantity -= 1;
        if ($product->quantity < 0) {
            throw new \Exception('No hay suficiente stock para este producto.');
        }
        $product->save();

        DB::commit(); // Confirmar la transacción

        return redirect()->route('sales.index')->with('success', 'Venta creada exitosamente.');
    } catch (\Exception $e) {
        // Deshacer la transacción
        DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    // Método para mostrar los detalles de una venta específica
    public function show(Sales $sale)
    {
        return view('sales.show', compact('sale'));
    }

    // Método para mostrar el formulario de edición de una venta
    public function edit($id)
    {
        // Encontrar la venta específica por su ID
        $sale = Sales::findOrFail($id);
        $products = Product::all();
        $categories = Category::all();
        $customers = Customer::all();

        return view('sales.edit', compact('sale', 'products', 'categories', 'customers'));
    }

    // Método para actualizar una venta en la base de datos
    public function update(Request $request, Sales $sale)
    {
        // Validar los datos del formulario
        $request->validate([
            'name_product' => 'required|string',
            'name_category' => 'required|string',
            'name_customer' => 'required|string',
            'date_sale' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'total' => 'required|numeric',
            'motivo' => 'required|string',
        ]);
        // Actualizar la venta
        $sale->update($request->all());

        return redirect()->route('sales.index')->with('success', 'Venta actualizada exitosamente.');
    }

    // Método para eliminar una venta de la base de datos
    public function destroy(Sales $sale)
    {
        // Aumentar la cantidad del producto
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
