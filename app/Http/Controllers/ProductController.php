<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Inventories;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Pest\Laravel\call;

class ProductController extends Controller
{
// Método para mostrar la lista de productos
public function index() : View
{
    $products = Product::with('category')->latest()->paginate(4);
    return view('products.index', compact('products'));
}


    // Método para mostrar el formulario de creación de productos
    public function create() : View
    {
        // Obtenemos todas las categorías para el formulario
        $products = Product::all();
        $categories = Category::all();
        $customers = Customer::all();;
        return view('products.create', compact('products', 'categories', 'customers'));

    }
   
    public function store(Request $request) : RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'motivo' => 'required|string',
            'description_short' => 'nullable|string',
            'description_large' => 'nullable|string',
            'colors' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);        

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Bandera 1: Después de la validación
            //dd('Paso 1: Validación completa', $request->all());

            // Crear el producto
            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description_short' => $request->description_short,
                'description_large' => $request->description_large,
                'colors' => $request->colors,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'motivo' => $request->motivo,
                'quantity' => $request->quantity, // Agregar esta línea
            ]);
            

            // Bandera 2: Después de crear el producto
            //dd('Paso 2: Producto creado', $product);

            // Verificar si el producto ya existe en el inventario
            $existingInventory = Inventories::where('id_product', $product->id)
                                            ->where('id_category', $request->category_id)
                                            ->first();

            if ($existingInventory) {
                // Incrementar la cantidad existente
                $existingInventory->increment('quantity', $request->quantity);
                // Bandera 3: Después de actualizar el inventario existente
                dd('Paso 3: Inventario actualizado', $existingInventory);
            } else {
                // Crear un nuevo registro en el inventario
                Inventories::create([
                    'id_product' => $product->id,
                    'id_category' => $request->category_id,
                    'quantity' => $request->quantity,
                ]);
                // Bandera 4: Después de crear el nuevo inventario
                //dd('Paso 4: Nuevo inventario creado');
            }

            DB::commit(); // Confirmar la transacción

            return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            // Deshacer la transacción
            DB::rollBack();
            // Bandera 5: Error durante la transacción
            dd('Error', $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    // Método para mostrar los detalles de un producto específico
    public function show(Product $product) : View
    {
        return view('products.show', compact('product'));
    }

    // Método para mostrar el formulario de edición de un producto
    public function edit(Product $product) : View
    {
        // Obtenemos todas las categorías para el formulario de edición
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) : RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'motivo' => 'required|string',
            'description_short' => 'nullable|string',
            'description_large' => 'nullable|string',
            'colors' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
        ]);        
    
        // Iniciar la transacción
        DB::beginTransaction();
    
        try {
            // Actualizar el producto
            $product->update([
                'code' => $request->code,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description_short' => $request->description_short,
                'description_large' => $request->description_large,
                'colors' => $request->colors,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'motivo' => $request->motivo,
                'quantity' => $request->quantity, // Agregar esta línea
            ]);
    
            // Verificar si el producto ya existe en el inventario
            $existingInventory = Inventories::where('id_product', $product->id)
                                            ->where('id_category', $request->category_id)
                                            ->first();
    
            if ($existingInventory) {
                // Incrementar la cantidad existente
                $existingInventory->increment('quantity', $request->quantity);
            } else {
                // Crear un nuevo registro en el inventario
                Inventories::create([
                    'id_product' => $product->id,
                    'id_category' => $request->category_id,
                    'quantity' => $request->quantity,
                ]);
            }
    
            DB::commit(); // Confirmar la transacción
    
            return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            // Deshacer la transacción
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    


    // Método para eliminar un producto de la base de datos
    public function destroy(Product $product) : RedirectResponse
    {
        // Eliminar el inventario asociado al producto si es necesario
        Inventories::where('id_product', $product->id)->delete();

        // Eliminamos el producto de la base de datos
        $product->delete();

        // Redireccionamos de vuelta a la lista de productos con un mensaje de éxito
        return redirect()->route('products.index')
                ->withSuccess('Producto eliminado con éxito.');
    }
}
