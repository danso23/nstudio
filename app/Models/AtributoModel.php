<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributoModel extends Model{
    protected $table = 'atributos';
    protected $primaryKey = 'id_atributo';
    protected $fillable = ['nombre_atributo', 'desc_atributo', 'desc_atributo', 'tipo_atributo', 'activo'];
    public $timestamps = false;
}
