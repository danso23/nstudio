<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionModel extends Model{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    protected $fillable = ['domicilio', 'pais', 'estado', 'codigo_postal', 'activo'];
    public $timestamps = false;
}
