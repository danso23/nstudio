<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\ProductoModel AS Producto;
use App\Models\CategoriaModel AS Categoria;
use App\Models\Carrusel;
use Illuminate\Support\Arr;
use App\Http\Controllers\UtilsController AS Utils;
use DB;

class ProductoController extends Controller{
    public function __construct(){
        $this->table ="productos";
        $this->id ="id_producto";
    }

    /******SECCIÓN ADMINISTRADO******/

    public function mostrarProductosView(){
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $datos = array('categorias' => $categorias );
    	return view('admin.productos')->with('datos', $datos);
    }

    /** JSON PARA ADMIN**/
    public function jsonProductos(){
        
        $productos = Producto::all()->toArray();

        
        // foreach($productos as $indexProd => $value){

        // }

        return Response::json($productos);
    }

    public function storeProducto(Request $request, $id){
        DB::beginTransaction();
        try {
            if($id != 0){
                $producto = Producto::where('id_producto', $id)
                ->update([
                    'nombre_producto' => $request->nombre,
                    'desc_producto' => $request->desc_curso,
                    'url_imagen' => $request->portada,
                    'id_categoria' => $request->categoria,
                    'cantidad_s' => $request->cantidad_s,
                    'cantidad_m' => $request->cantidad_m,
                    'cantidad_g' => $request->cantidad_g,
                ]);
                $result = array(
                    "Error" => false,
                    "message" => "Se ha editado con exito el curso con folio [$id]"
                );
            }
            else{
                $producto = new Producto();
                $producto->nombre_producto = $request->nombre;
                $producto->desc_producto = $request->desc_curso;
                $producto->url_imagen = $request->portadaFile;
                $producto->url_imagen2 = $request->portadaFile2;
                $producto->url_imagen3 = $request->portadaFile3;
                $producto->url_imagen4 = $request->portadaFile4;
                $producto->url_imagen5 = $request->portadaFile5;
                $producto->url_imagen6 = $request->portadaFile6;
                $producto->id_categoria = $request->categoria;
                $producto->precio = $request->precio;
                $producto->cantidad_s = $request->cantidad_s;
                $producto->cantidad_m = $request->cantidad_m;
                $producto->cantidad_g = $request->cantidad_g;
                $producto->busto_s = $request->busto_s;
                $producto->busto_m = $request->busto_m;
                $producto->busto_g = $request->busto_g;
                $producto->largo_s = $request->largo_s;
                $producto->largo_m = $request->largo_m;
                $producto->largo_g = $request->largo_g;
                $producto->manga_s = $request->manga_s;
                $producto->manga_m = $request->manga_m;
                $producto->manga_g = $request->manga_g;
                $producto->color = $request->color;
                $producto->activo = 1;
                $producto->save();
                $result = array(
                    "Error" => false,
                    "message" => "Se ha guardado con exito el producto ",
                    "iId" => $producto->id
                );
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            $result = array(
                "Error" => true,
                "message" => "Ha ocurrido un error, por favor contacte al administrador o inténtelo más tarde | ".$e
            );
            return Response::json($result);
        }
        DB::commit();
        return Response::json($result);
    }

    public function productoXCategoriaJson($id){
        $productos = Producto::join('categorias', 'productos.id_categoria', 'categorias.id_categoria')
        ->selectRaw('productos.id_producto, categorias.nombre_categoria, productos.nombre_producto, productos.desc_producto, productos.url_imagen, productos.url_imagen2, productos.url_imagen3, productos.url_imagen4, productos.url_imagen5, productos.precio, productos.cantidad_s, productos.cantidad_m, productos.cantidad_g, productos.busto_s, productos.busto_m, productos.busto_g, productos.largo_s, productos.largo_m, productos.largo_g, productos.manga_s, productos.manga_m, productos.manga_g')
        ->where('productos.id_categoria', $id)
        ->where('productos.activo', 1)
        ->get();
        $utils = new Utils();
        foreach($productos as $producto){
            $monedaConvertida = $utils->convertCurrency($producto->precio);//$this->convertCurrency($producto->precio);
            $producto->precio = $monedaConvertida;
        }
        $productos;
        return Response::json($productos);
        
    }
    /******FIN SECCIÓN ADMINISTRADO******/
    public function index(){
    	$productos = Producto::where('activo', '1')->get();
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $utils = new Utils();
        foreach($productos as $producto){
            $monedaConvertida = $utils->convertCurrency($producto->precio);//$this->convertCurrency($producto->precio);
            $producto->precio = $monedaConvertida;
        }
        $datos = array('productos' => $productos, 'categorias' => $categorias);
    	return view('productos')->with('datos', $datos);
    }

    public function home(){
    	$productos = Producto::where('activo', '1')->take(3)->get();
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria, icono')->get();
        $carrusel = Carrusel::where('activo', '1')->get();
        $utils = new Utils();
        foreach($productos as $producto){
            $monedaConvertida = $utils->convertCurrency($producto->precio);//$this->convertCurrency($producto->precio);
            $producto->precio = $monedaConvertida;
        }
        $datos = array('productos' => $productos, 'categorias' => $categorias, 'carrusel' => $carrusel);
    	return view('home')->with('datos', $datos);
    }

    public function productoDescripcion($id){
    	        
        $productos  = Producto::where('id_producto', $id)->get();
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        
        $utils = new Utils();        

        $tempProductos = json_decode(json_encode($productos), true);
        $arrayImagenes = [];
        foreach($tempProductos as $index => $NodoProd){
            
            foreach($NodoProd as $indexNodo => $valorNodo){
                if(preg_match('/^Url_imagen[0-9]?/i', $indexNodo)){                    
                    $arrayImagenes[$indexNodo] = $valorNodo;
                }

            }            
        }
                
        if(!empty($productos[0])){
            $monedaConvertida     = $utils->convertCurrency($productos[0]->precio);//$this->convertCurrency($productos[0]->precio);
            $productos[0]->precio = $monedaConvertida;
        }
        else{
            $productos[0] = "";
        }
        
        $datos = array('productos' => $productos[0], 'categorias' => $categorias, 'imagenes' => $arrayImagenes);  
    	
        return view('producto_descripcion')->with('datos', $datos);
    }

    public function productoXCategoria($id){
        $productos = Producto::join('categorias', 'productos.id_categoria', 'categorias.id_categoria')
        ->selectRaw('productos.id_producto, categorias.nombre_categoria, productos.nombre_producto, productos.desc_producto, productos.url_imagen, productos.precio, productos.cantidad_s, productos.cantidad_m, productos.cantidad_g, productos.busto_s, productos.busto_m, productos.busto_g, productos.largo_s, productos.largo_m, productos.largo_g, productos.manga_s, productos.manga_m, productos.manga_g')
        ->where('productos.id_categoria', $id)
        ->where('productos.activo', 1)
        ->get();
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $utils = new Utils();
        foreach($productos as $producto){
            $monedaConvertida = $utils->convertCurrency($producto->precio);//$this->convertCurrency($producto->precio);
            $producto->precio = $monedaConvertida;
        }
        $datos = array('productos' => $productos, 'categorias' => $categorias);
        return view('categoria')->with('datos', $datos);
        
    }

    public function buscador(Request $request){
        $p = $this->table; ##Productos
        $buscador = (isset($request->buscador) && $request->buscador != "") ? $request->buscador : '';
        $productos = Producto::where("$p.nombre_producto", "LIKE", '%'. $buscador .'%')
            ->join('categorias as c', "$p.id_categoria", 'c.id_categoria')
            ->selectRaw("$p.id_producto, $p.id_categoria, c.nombre_categoria, $p.nombre_producto, $p.desc_producto, $p.url_imagen, $p.precio, $p.cantidad_s, $p.activo")
        ->get();
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $datos = array('buscador' => $productos, 'categorias' => $categorias );
        return view('productos')->with('datos', $datos);
    }

    public function quienesSomos(){
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $datos = array('categorias' => $categorias);
        return view('quienesSomos')->with('datos', $datos);
    }

    /**
     * Todos los productos
     * JSON
     */
    function productosAll() {
        $productos = Producto::where('activo', '1')->get();
        return response()->json($productos);
    }

    public function historia(){
        return view('historia');
    }
}