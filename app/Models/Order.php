<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Definir las columnas que pueden ser llenadas masivamente (fillable)
    protected $fillable = [
        'user_id', 
        'status', 
        'total_price', 
        'created_at', 
        'updated_at'
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'order_pizza');
    }

 
    public function extraIngredients()
    {
        return $this->belongsToMany(ExtraIngredient::class, 'order_extra_ingredient');
    }

    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}