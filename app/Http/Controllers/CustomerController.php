<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{   
    // Método para mostrar la lista de clientes
    public function index()
    {
        // Obtenemos todos los clientes paginados
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }
    // Método para mostrar el formulario de creación de clientes
    public function create()
    {
        return view('customers.create');
    }
    // Método para almacenar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'rfc' => 'required|string|max:13',
        ]);
        // Creamos un nuevo cliente
        Customer::create($request->all());
        // Redireccionamos a la lista de clientes con un mensaje de éxito
        return redirect()->route('customers.index')->with('success', 'Cliente creado exitosamente.');
    }
    // Método para mostrar un cliente
    public function show(Customer $customer)
    {   
        // Obtenemos el cliente por su id
        return view('customers.show', compact('customer'));
    }
    // Método para mostrar el formulario de edición de clientes
    public function edit(Customer $customer)
    {
        // Obtenemos el cliente por su id
        return view('customers.edit', compact('customer'));
    }
    // Método para actualizar un cliente
    public function update(Request $request, Customer $customer)
    {
        // Validamos los datos del formulario
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'rfc' => 'required|string|max:13',
        ]);
        // Actualizamos el cliente
        $customer->update($request->all());
        // Redireccionamos a la lista de clientes con un mensaje de éxito
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado exitosamente.');

    }
    // Método para eliminar un cliente
    public function destroy(Customer $customer)
    {
        // Eliminamos el cliente
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado exitosamente.');
    }
    
}
