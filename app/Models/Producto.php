<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use softDeletes;
    protected $fillable = [
        'tipo',
        'descripcion',
        'imagen',
        'precio',
        'existencia'
    ];
}
