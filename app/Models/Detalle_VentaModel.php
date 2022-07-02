<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_VentaModel extends Model{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle_venta';
    protected $fillable = ['id_venta', 'id_producto', 'precio', 'cantidad'];
    public $timestamps = false;
}
