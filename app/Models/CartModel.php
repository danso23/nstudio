<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model{
    protected $table = 'carro_compras';
    protected $primaryKey = 'id_carro_compras';
    protected $fillable = ['nombre_carro_compras', 'id_producto', 'precio', 'cantidad'];
    public $timestamps = false;
}
