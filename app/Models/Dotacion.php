<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotacion extends Model
{
    protected $fillable = [

        'centro_costo',
        'nombre_centro',
        'item',
        'nombre_item',
        'color',
        'tallas'

    ];
}
