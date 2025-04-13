<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizza extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $table = 'pizzas';
    public $timestamps = true;
    
    public function pizzas() {
        return $this->belongsToMany(Pizza::class);
    }
}
