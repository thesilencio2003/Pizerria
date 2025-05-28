<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaRawMaterial extends Model
{
    protected $fillable = ['name', 'quantity'];
    protected $table = 'raw_materials'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false;
}