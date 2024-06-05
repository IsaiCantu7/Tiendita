<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address', 'rfc',
    ];
    // Relación uno a muchos con la tabla sales
    public function sales()
    {
        // Un cliente puede tener muchas ventas
        return $this->hasMany(Sales::class);
    }
}
