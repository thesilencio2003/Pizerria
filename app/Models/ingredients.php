<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredients extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'description',
        'stock_quantity',
        'unit', // Ejemplo: gramos, piezas, litros, etc.
    ];

    // Relaciones (opcional, si vas a vincular ingredientes con pizzas)
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'ingredient_pizza')
                    ->withTimestamps();
    }
}
