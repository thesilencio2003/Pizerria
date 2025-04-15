<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaSize extends Model
{
    use HasFactory;

  
    protected $table = 'pizza_size';


    protected $primaryKey = 'id';

    
    public $timestamps = true;


    protected $fillable = [
        'pizza_id',
        'size',
        'price',
    ];

    protected $casts = [
        'size' => 'string',  
        'price' => 'decimal:2', 
    ];


    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id', 'id');
    }

    
}