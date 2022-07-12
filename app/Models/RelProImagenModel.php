<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelProImagenModel extends Model{
    protected $table = 'rel_img_prod';
    protected $primaryKey = 'id_relacion';
    protected $fillable = ['id_img','id_prod'];
    public $timestamps = false;
}
