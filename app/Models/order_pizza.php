<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_pizza extends Model
{
    use HasFactory;
    protected $table = 'order_pizza';         
    protected $primaryKey = 'id';       
    public $timestamps = false; 

    public function pizzaSize()
    {
        return $this->belongsTo(PizzaSize::class, 'pizza_size_id');
    }
}