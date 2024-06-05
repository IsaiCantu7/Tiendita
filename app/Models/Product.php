<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Utilizamos el trait HasFactory para generar factories para el modelo
    use HasFactory;

    // Especificamos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'code', 
        'name', 
        'quantity', 
        'purchase_price', 
        'sale_price', 
        'motivo', 
        'description_short', 
        'description_large', 
        'colors', 
        'category_id'
        ];
    

    // Relación uno a muchos con la tabla categories
    public function category()
    {
        // Un producto pertenece a una categoría
        return $this->belongsTo(Category::class);
    }
    
    // Relación uno a muchos con la tabla inventories
    public function sales()
    {
        // Un producto puede tener muchas ventas
        return $this->hasMany(Sales::class);
    }
}
