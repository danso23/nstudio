<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'ProductoController@home')->name('home');
/****PRODUCTOS****/
Route::get('productos', 'ProductoController@index')->name('productos');
Route::get('productos/detalle/{id}', 'ProductoController@productoDescripcion')->name('producto.detalle');
Route::get('home', 'ProductoController@home')->name('home');
##ProductoXcategoria
Route::get('categoria/{id}', 'ProductoController@productoXCategoria')->name('categoria');
Route::get('jsoncategoria/{id}', 'ProductoController@productoXCategoriaJson')->name('categoria.json');
##Buscador
Route::get('buscador-productos', 'ProductoController@buscador')->name('buscador');
##Productos Todos
Route::get('json/productosall', 'ProductoController@productosAll')->name('json.productosall');
/****FIN PRODUCTOS****/

/****CATEGORIAS****/
Route::get('categorias', 'CategoriaController@index')->name('categorias');
/****FIN CATEGORIAS****/

/****ATRIBUTOS****/
Route::post('atributos-producto/{id}', 'Producto_AtributoController@getAtributosXProducto')->name('atributos.producto');
/****FIN ATRIBUTOS****/

/****CARRITO****/
Route::post('cart-add', 'CartController@add')->name('cart.add');
Route::get('cart/checkout', 'CartController@cart')->name('cart.checkout');
Route::post('remove-item', 'CartController@removeItem')->name('cart.remove');
Route::post('completa-envio', 'CartController@guardaEnvio')->name('guarda.envio');

/**** PAYMENT *****/
Route::get('/payment', 'PaymentController@index')->name('payment');
Route::post('/payment/processPayment', 'PaymentController@processPayment')->name('processPayment');
Route::post('/payment/paymentIntent', 'PaymentController@paymentIntent')->name('paymentIntent');
/******* TICKET *********/
Route::get('/payment/ticket', 'PaymentController@ticket')->name('payment.ticket');

Route::get('quienes-somos', 'ProductoController@quienesSomos')->name('quienes.somos');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::group(['prefix' => 'admin'], function() {
    Route::get('/catalogoproductos', 'ProductoController@mostrarProductosView')->name('Catalogo.Productos');//->middleware('auth');
    Route::get('/catalogoproductos_beta', 'ProductoController@mostrarProductosView_beta')->name('Catalogo.ProductosBeta');//->middleware('auth');
    Route::get('/jsonproductos', 'ProductoController@jsonProductos')->name('json.productos');//->middleware('auth');

    /** GUARDADO**/
    Route::post('/storeProducto/{id}', 'ProductoController@storeProducto')->name('admin.storeProducto');
    
    Route::post('/storeProducto_beta', 'ProductoController@storeProductoBeta')->name('admin.storeProducto_beta');
    Route::post('/processimg', 'ProductoController@processimg')->name('admin.processimg');
    Route::post('/changecover', 'ProductoController@changecover')->name('admin.changecover');    
});

Route::get('/historia', 'ProductoController@historia')->name('historia');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
