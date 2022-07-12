<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenModel extends Model{
    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagen';
    protected $fillable = ['path_url'];
    public $timestamps = false;
}
