<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Producto_AtributoModel;
use App\Models\ProductoModel AS Producto;
use App\Models\AtributoModel AS Atributo;
class Producto_AtributoController extends Controller{

    public function __construct(){
        $this->table ="productos_atributos";
        $this->fk_table= "atributos";
    }
    public function getAtributosXProducto($id){
        $pa = $this->table;
        $a= $this->fk_table;
        $result = Atributo::join("$pa", "$pa.id_atributo", "$a.id_atributo")
        ->selectRaw("$a.nombre_atributo, $a.tipo_atributo")
        ->where("$pa.id_producto", $id)->get();
        return response()->json($result);
    }
}
