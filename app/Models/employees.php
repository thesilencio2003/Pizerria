<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;
       protected $fillable = [
        'user_id',
        'position',
        'identification_number',
        'salary',
        'hire_date',
    ];
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
{
    return $this->belongsTo(User::class);
}
}
