<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaModel extends Model{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = ['fecha_venta', 'total_productos'];
    public $timestamps = false;
}
