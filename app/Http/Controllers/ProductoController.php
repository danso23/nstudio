<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Response;
use App\Models\ProductoModel AS Producto;
use App\Models\ImagenModel AS Imagen;
use App\Models\RelProImagenModel AS RelProImagen;
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

    public function mostrarbeta(){
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $datos = array('categorias' => $categorias );
        return view('admin.productos_beta')->with('datos', $datos);
    }
    

    /** JSON PARA ADMIN**/
    public function jsonProductos(){    
        $productos = Producto::all()->toArray();
        return response()->json($productos);
    }

    // public function processimg(Request $request){

    //     // return response()->json($result);        

    //     // session()->put('pedido_virtual',$origen);
        
    //     // $contenedor_img = \Session::get('contenedor_img');
        
    //     if(\Session::has('contenedor_img')){

    //         $return['cMensaje'] = "Si existio variable sesion";
    //         $arrayImgSession = \Session::get('contenedor_img');
    //     }

    //     // $arrayImgSession[] = count();
    //     $arrayImgSession[] = $request->file('file')[0];//->getClientOriginalName();//$request->file('file');
        
    //     \Session::put('contenedor_img',$arrayImgSession);    

    //     $return['lError']   = false;
    //     $return['imagenes'] = \Session::get('contenedor_img');
    //     // $contenedor_img[] = $Imagen->getClientOriginalExtension();        
    //     // \Session::put('contenedor_img',$contenedor_img);
    //     // $return['extensiones'] = $contenedor_img;// \Session::get('contenedor_img');
    //     // \Session::get('contenedor_img')

    //     return response()->json($return,200);

    // }

    function getitemimg(Request $request){


        $data['data'] =  RelProImagen::where('rel_img_prod.id_prod',$request->refereimg)
                ->join('imagenes','imagenes.id_imagen','rel_img_prod.id_img')
                ->select('rel_img_prod.id_img as idimgrel','rel_img_prod.id_prod as item','imagenes.path_url as url_path','imagenes.cover as coverimg')
                ->orderby('imagenes.cover','desc')
                ->get()
                ->toArray();

        $data['lError'] = false;

        return response()->json($data,200);



    }


    public function processimg(Request $request){

        $slash = "\\";
        $slasremp = '/';

        if (DIRECTORY_SEPARATOR === '/') {
            // unix, linux, mac
            $slash = "/";
            $slasremp = '\\';
        }

        $Files = $request->file('file');
        $Number_Producto = "producto_".$request->ruta;        
        
        $ruta['real']   = public_path().$slash."img".$slash."productos".$slash.$Number_Producto;
        // return response()->json($ruta, 200);        
        $ruta['asset']  = "/img/productos/".$Number_Producto."/";//asset('public')

        if(is_array($Files)){            
            $respuesta = $this->SetImagen($Files,true,$ruta);
        }
        else{
            $respuesta = $this->SetImagen($Files,false,$ruta);
        }
        
        $arregloUpdate = [];

        foreach($respuesta['data'] as $indexImg => $valorIMG){            

            $idImg = Imagen::create(['path_url' => $valorIMG['RutaImagen']])->id_imagen;
            RelProImagen::create(
                ['id_img' => $idImg,//Imagen::create(['path_url' => $valorIMG['RutaImagen']])->id_imagen,
                 'id_prod' => $request->ruta
                ]
            );            
            $respuesta['imgUp'][$indexImg]['idImg'] = $idImg;
        }
        

        $respuesta['data'] =  RelProImagen::where('rel_img_prod.id_prod',$request->ruta)
                ->join('imagenes','imagenes.id_imagen','rel_img_prod.id_img')
                ->select('rel_img_prod.id_img as idimgrel','rel_img_prod.id_prod as item','imagenes.path_url as url_path','imagenes.cover as coverimg')
                ->orderby('imagenes.cover','desc')
                ->get()
                ->toArray();

        $respuesta['lError'] = false;        
        $respuesta['infoFile'] = $Files;          

        return response()->json($respuesta, 200);
    }

    public function changecover(Request $request){
                
        // $idItem     = $request->hhuiid;        
        $dataReturn = [];
        $coverActual =  RelProImagen::where('rel_img_prod.id_prod',$request->uuidprod)
                        ->where('imagenes.cover',1)
                        ->join('imagenes','imagenes.id_imagen','rel_img_prod.id_img')                        
                        ->select('rel_img_prod.id_img as idimgrel')
                        ->get()
                        ->toArray();                                     
        
        
        if(!empty($coverActual)){
            $unSetCover = Imagen::where('id_imagen',$coverActual[0]['idimgrel'])                        
                        ->update([
                            'cover' => 0                            
                        ]);                                        
        }
        
    

        $coverNuevo =  RelProImagen::where('rel_img_prod.id_prod',$request->uuidprod)
                        ->where('rel_img_prod.id_img',$request->setcover)                    
                        ->join('imagenes','imagenes.id_imagen','rel_img_prod.id_img')
                        // ->select('rel_img_prod.id_img as idimgrel','rel_img_prod.id_prod as item','imagenes.path_url as url_path','imagenes.cover as coverimg')
                        ->select('rel_img_prod.id_img as idimgrel')
                        ->get()
                        ->toArray();
         ;
        if(!empty($coverNuevo)){
            $setCover = Imagen::where('id_imagen',$coverNuevo[0]['idimgrel'])                        
                        ->update([
                            'cover' => 1
                        ]);  
            //return response()->json($setCover,200);
            if($setCover){
                $dataReturn['cMensaje']  = 'Actualización de la portada realizado con exito';
                $dataReturn['lError']    = false;
            }
            else{
                $dataReturn['cMensaje']  = "Ocurrio un detalle al momento de actualizar";
                $dataReturn['lError']    = true;
            }
        }
        else{
            $dataReturn['cMensaje']  = "Ocurrio un detalle al momento de actualizar";
            $dataReturn['lError']    = true;
        }        

        return response()->json($dataReturn,200);
    }

    function SetImagen($file, $bArreglo, $ruta){

        $arregloImagenesDone = array(); 

        try{                        
            
            if($bArreglo){
                foreach ($file as $index => $fileUno) {
                    
                    $Extension      = $fileUno->getClientOriginalExtension();
                    $NombreImagen   = $this->LimpiarNombres($fileUno->getClientOriginalName());                   
                                        
                    $arregloImagenesDone['RutaImagen']   = $ruta['asset'].$NombreImagen;
                    $fileUno->move($ruta['real'],$NombreImagen);//$arregloImagenesDone['RutaImagen']);

                    $arrgloFinal[] = $arregloImagenesDone;
                }

            }

            $SuperFile    = $file;            
            $data['data'] = $arrgloFinal;

        } catch (Exception $e) {
            $data['cError'] = $e->getMessage();            
        }

        return $data;
        //return response()->json($data, 200);
        //echo json_encode($Data);
    }

    function LimpiarNombres($NombreLimpioImagen){


        $caracteres = array(" ","-","&","!",
                            "#","$","%","/",
                            "(",")","=","'",
                            "?","¿","¡","*",
                            "+","~","}","]",
                            "`","ñ","Ñ","{",
                            "[","^",":",",",
                            ";","|","°","¬");            
        $replace = '';
                
        $NombreLimpioImagen = str_replace($caracteres, $replace, $NombreLimpioImagen);

        $tildes  = array('á','é','í','ó','ú');
        $vocales = array('a','e','i','o','u');

        $NombreLimpioImagen = str_replace($tildes, $vocales, $NombreLimpioImagen); 

        return $NombreLimpioImagen;
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
            return response()->json($result);
        }
        DB::commit();
        return response()->json($result);
    }

    public function storeProductoBeta(Request $request){
        DB::beginTransaction();
        
        // $Peticion = $request->all();
        // $data = $request->all();
        // print_r($Peticion);
        // return response()->json($request->nombre);

        try {
            if($request->modalidad == "Editar"){
                $producto = Producto::where('id_producto', $request->hdditem)
                ->update([
                    'nombre_producto' => $request->nombre,
                    'desc_producto'   => $request->desc_prod,
                    // 'url_imagen'      => $request->portada,
                    'precio'          => str_replace("$","",$request->precio),
                    'id_categoria'    => $request->categoria_cloths,
                    'color'           => $request->color_clothes,
                    'cantidad_s'      => $request->tall_xs,
                    'cantidad_m'      => $request->talla_md,
                    'cantidad_g'      => $request->talla_lg,
                ]);
                $result = array(
                                        
                    "lError" => false,
                    "cMensaje" => "Se ha editado con exito el curso con folio [$request->hdditem]",
                    "cError" => $request->hdditem
                );
            }
            else{


                $producto = new Producto();
                $producto->nombre_producto  = $request->nombre;
                $producto->desc_producto    = $request->desc_prod;
                $producto->precio           = $request->precio;
                $producto->id_categoria     = $request->categoria_cloths;
                $producto->color            = $request->color_clothes;

                $producto->cantidad_s       = $request->tall_xs;
                $producto->cantidad_m       = $request->talla_md;
                $producto->cantidad_g       = $request->talla_lg;


                // $producto->url_imagen = $request->portadaFile;
                // $producto->url_imagen2 = $request->portadaFile2;
                // $producto->url_imagen3 = $request->portadaFile3;
                // $producto->url_imagen4 = $request->portadaFile4;
                // $producto->url_imagen5 = $request->portadaFile5;
                // $producto->url_imagen6 = $request->portadaFile6;

                
                
                
                // $producto->busto_s = $request->busto_s;
                // $producto->busto_m = $request->busto_m;
                // $producto->busto_g = $request->busto_g;
                // $producto->largo_s = $request->largo_s;
                // $producto->largo_m = $request->largo_m;
                // $producto->largo_g = $request->largo_g;
                // $producto->manga_s = $request->manga_s;
                // $producto->manga_m = $request->manga_m;
                // $producto->manga_g = $request->manga_g;
                
                $producto->activo = 1;

                $producto->save();
                
                $result = array(
                    "lError" => false,
                    "cMensaje" => "Se ha guardado con exito el producto ",
                    "cError" => $producto->id_producto
                );
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            $result = array(
                "Error" => true,
                "message" => "Ha ocurrido un error, por favor contacte al administrador o inténtelo más tarde | ".$e
            );
            return response()->json($result);
        }
        DB::commit();
        return response()->json($result);
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
        return response()->json($productos);
        
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