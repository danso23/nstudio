<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Charge as ChargeDB;
use App\Models\VentaModel as Venta;
use App\Models\Detalle_VentaModel as Detalle;
use App\Models\CategoriaModel AS Categoria;
use Stripe;
use Cart;
use DB;

class PaymentController extends Controller
{
    public function index(){
        return view('payment.payment');
    }

    /** OXXO PAY **/
    public function paymentIntent(Request $request){
        $total = \Cart::getTotal();
        $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $intent = \Stripe\PaymentIntent::create([
            "amount" => $total * 100,
            "currency" => "mxn",
            "payment_method_types" => ["oxxo"]
        ]);
        return response()->json(["intent" => $intent]);
    }

    // Metodo que procesa el pago y realiza el registro tanto en la DB como en la plataforma de stripe.
    public function processPayment(Request $request){
        $total = \Cart::getTotal();
        // Validacion para el envio de los datos que son necesarios para proceder a la compra
        $this->validate($request, [
            'card_no' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',
        ]);
        DB::beginTransaction();
        try {

            // Se inicializa el stripe con la clave secreta, aqui se debe de remplazar por la del cliente
            // esta se otorga al crear una cuenta en stripe
            $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
            // Crea la tarjeta o token que servira para realizar el pago
            $response = \Stripe\Token::create([
                "card" => array(
                    "number"    => $request->input('card_no'),
                    "exp_month" => $request->input('expiry_month'),
                    "exp_year"  => $request->input('expiry_year'),
                    "cvc"       => $request->input('cvv')
                )
            ]);
                
            $venta = new Venta();
            $venta->fecha_venta = date('Y-m-d');
            $venta->total_productos = \Cart::getTotalQuantity();
            $venta->save();
            
            $id_venta = (isset($venta->id_venta) && $venta->id_venta != "") ? $venta->id_venta : "";
            $cartCollection = \Cart::getContent();
            foreach ($cartCollection as $r){
                $detalle = new Detalle();
                $detalle->id_venta = $id_venta;
                $detalle->id_producto = $r->id;
                $detalle->precio = $r->price;
                $detalle->cantidad = $r->quantity;
                $detalle->save();
            }

            // Se genera el cargo a pagar y se pasa la terjeta previamente creada
            $charge = \Stripe\Charge::create([
                'currency' => 'MXN',
                'amount' =>  $total * 100,
                'description' => 'Compra N°' . $id_venta,
                'source' => $response['id']
            ]);

            // Se guarda el pago en la DB para mantener el registro, al igual que se guarda en la plataforma
            // de stripe.
            $chargeDB = new ChargeDB();
            $chargeDB->cardholder = $request->input('cardholder');
            $chargeDB->stripe_id = $charge['id'];
            $chargeDB->card_brand = $response['card']['brand'];
            $chargeDB->card_last_four = $response['card']['last4'];
            $chargeDB->total = $total;
            $chargeDB->save();

            $datos = array(
                'id_compra'     => $id_venta,
                'productos'     => $cartCollection,
                'total_compra'  => $total,
                'fecha'         => date('d/m/Y'),
                'direccion'     => $request->input('direccion'),
                'estado'        => $request->input('estado'),
                'pais'          => $request->input('pais'),
                'cp'            => $request->input('cp'),
                'cliente'        => $request->input('cardholder')
            );
            DB::commit();
            $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
            $datos['categorias'] =$categorias;
            // Se hace el redirect a la misma pagina con un mensaje de error o exito.
            if($charge['status'] == 'succeeded') {
                \Cart::clear();
                $datos['success'] = 'La compra se ha realizado con éxito';
                return view('ticket')->with('datos', $datos);
            } else {
                return redirect('payment')->with('error', 'Algo salió mal, por favor intenta de nuevo o contacta al administrador.');
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect('payment')->with('error', $e->getMessage());
        }
    }

    public function ticket($ticket = array()){
        $categorias = Categoria::where('activo', '1')->selectRaw('id_categoria, nombre_categoria')->get();
        $datos['categorias'] =$categorias;
        return view('ticket');
    }
}
