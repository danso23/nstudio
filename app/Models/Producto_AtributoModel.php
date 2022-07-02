<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto_AtributoModel extends Model{
    protected $table = 'productos_atributos';
    protected $primaryKey = 'id_producto_detalle';
    protected $fillable = ['id_producto', 'id_atributo'];
}
