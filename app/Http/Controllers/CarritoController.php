<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarritoModel;
use App\Models\ProductoModel;
class CarritoController extends Controller{
    
    public function agregar(Request $request){
        //print_r(csrf_token());
        
        /*$producto = ProductoModel::find($request->id);
        if($request->cantidad > $producto->cantidad){
            return response()->json(["messagge" => "No se encuentran disponible $producto->nombre_producto, actualmente se encuentran $producto->cantidad en stock"]);
            return false;
        }
        $carrito = new CarritoModel;
        $carrito->id_producto           = $producto->id_producto;
        $carrito->nombre_carro_compras  = $producto->nombre_producto;
        $carrito->precio                = $producto->precio;
        $carrito->cantidad              = $request->cantidad;
        $carrito->save();
        
        return response()->json(["messagge" => "Se agrego $producto->nombre_producto al carrito"]);*/
    }
}
