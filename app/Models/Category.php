<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Utilizamos el trait HasFactory para generar factories para el modelo
    use HasFactory;

    // Especificamos los campos
    protected $fillable = [
        'name',
        'description',
    ];
    // Relación uno a muchos con la tabla products
    public function products()
    {
        // Un producto pertenece a una categoría
        return $this->hasMany(Product::class);
    }
}
