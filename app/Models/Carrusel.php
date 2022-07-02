<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrusel extends Model
{
    protected $table = 'carrusel';
    protected $primaryKey = 'id_carrusel';
    protected $fillable = ['nombre', 'descripcion', 'url', 'activo'];
    public $timestamps = false;
}
