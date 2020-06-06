<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Category;
use App\Tracking;
use Carbon\Carbon;
use App\Subcategory;
use App\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMerchant()
    {
        
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $merchant_id = Auth::user()->id_comercio;

        $users = User::select('id')->where('id_comercio', $merchant_id)->get();

        $orders = DB::table('orders')->where('pago_exitoso', 1)->whereIn('user_id', $users)->get();


        return view('orders')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'orders' => $orders
        ]);

    }

    public function trackingDetails($id){

        $categories = Category::all();
        $subcategories = Subcategory::all();

        $order = Order::where('id', $id)->firstOrFail();

        $merchant = User::where('id', $order->user_id)->firstOrFail();

        $date  = $order->created_at->format('d/m/Y');

        
        $trackingsEstado = DB::table('trackings')->select('estado')->where('id_pedido', $id)->get();

        $trackingEstado = 0;

        foreach ($trackingsEstado as $tracking) {
            if ($tracking->estado == "Sin procesar") {
                $trackingEstado = 1;
            }
        }

        foreach ($trackingsEstado as $tracking) {
            if ($tracking->estado == "Procesando") {
                $trackingEstado = 2;
            }
        }

        foreach ($trackingsEstado as $tracking) {
            if ($tracking->estado == "En Orderit") {
                $trackingEstado = 3;
            }
        }

        foreach ($trackingsEstado as $tracking) {
            if ($tracking->estado == "Para Enviar") {
                $trackingEstado = 4;
            }
        }

        foreach ($trackingsEstado as $tracking) {
            if ($tracking->estado == "Entregado") {
                $trackingEstado = 5;
            }
        }
        

        // dd($trackingEstado);
    
        return view('tracking-details')->with([
            'order' => $order,
            'date' => $date,
            'merchant' => $merchant,
            'estado' => $trackingEstado,
            'categories' => $categories,
            'subcategories' => $subcategories, 
        ]);
    }

    public function orderDetails($id)
    {

        $categories = Category::all();
        $subcategories = Subcategory::all();


        $order = Order::where('id', $id)->firstOrFail();

        $merchant = User::where('id', $order->user_id)->firstOrFail();

        $establishment = Establishment::where('id', $merchant->id_comercio)->firstOrFail();

        $productsIds = DB::table('order_product')->where('order_id', $id)->get();
        
        $orderProducts = DB::table('product_types')
            ->leftJoin('order_product', 'product_types.id', '=', 'order_product.product_id')
            ->where('order_product.order_id', $id)
            ->get();
        
        $products = DB::table('product_types')->whereIn('id', array_column(json_decode($orderProducts), 'product_id'))->get();

        return view('details')->with([
            'order' => $order,
            'merchant' => $merchant,
            'establishment' => $establishment,
            'orderProducts' => $orderProducts,
            'products' => $products,
            'categories' => $categories, 
            'subcategories' => $subcategories,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $total = 0;

        $supplier_id = Auth::user()->id_comercio; //id proveedor

        $trackings = DB::table('trackings')->where('id_establecimiento', $supplier_id)->get();

        $orders_id = Tracking::select('id_pedido')->where('id_establecimiento', $supplier_id)->get();

        $orders = DB::table('orders')->where('pago_exitoso', 1)->whereIn('id', $orders_id)->get(); // todos los pedidos // agregar que el pago debe ser "1"
    
        $productsIds = DB::table('order_product')->whereIn('order_id', array_column(json_decode($orders), 'id'))->get();
        
        $orderProducts = array_filter(json_decode($productsIds), function($values) use($supplier_id){
           
            $test = DB::table('product_types')->select('establishment_id')->where('id', $values->product_id)->get();

            if ($test[0]->establishment_id == $supplier_id) {
                return true;
            }else{
                return false;
            }
            
        });

    
        //Calcular total de la parte del pedido que corresponde a este proveedor
        foreach ($orders as $order) { 

            foreach ($orderProducts as $orderProduct) {

                if ($orderProduct->order_id == $order->id) {

                    $producto = DB::table('product_types')->select('precio')->where('id', $orderProduct->product_id)->first();
                       
                    $producto->precio = $producto->precio * $orderProduct->cantidad;

                    $total = $total + $producto->precio;
                }
            }

            $order->subtotal = $total;
            $total = 0;
        }
 
        
       
        return view('gestionar-pedidos')->with([
            'orders' => $orders,
            'trackings' => $trackings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $total = 0;
        
        $categories = Category::all();

        $subcategories = Subcategory::all();

        
        $order = Order::where('id', $id)->firstOrFail();

        $merchant = User::where('id', $order->user_id)->firstOrFail();


        $supplier_id = Auth::user()->id_comercio; //id proveedor
        

        $productsIds = DB::table('order_product')->where('order_id', $id)->get();


        $establishment = Establishment::where('id', $merchant->id_comercio)->firstOrFail();


    
        $orderProducts = array_filter(json_decode($productsIds), function($values) use($supplier_id){
           
            $test = DB::table('product_types')->select('establishment_id')->where('id', $values->product_id)->get();

            if ($test[0]->establishment_id == $supplier_id) {
                return true;
            }else{
                return false;
            }
            
        });

        $products = DB::table('product_types')->whereIn('id', array_column($orderProducts, 'product_id'))->get(); //todos los productos

        
        //Calcular total de la parte del pedido que corresponde a este proveedor
  
        foreach ($orderProducts as $orderProduct) {

            if ($orderProduct->order_id == $order->id) {


                $producto = DB::table('product_types')->select('precio')->where('id', $orderProduct->product_id)->first();
                   
                $producto->precio = $producto->precio * $orderProduct->cantidad;

                $total = $total + $producto->precio;
            }
        }

        $order->subtotal = $total;
        $total = 0;
        

        //Actualizar estado a "Procesando"

        $trackingEstado = DB::table('trackings')->select('estado')->where('id_pedido', $order->id)->where('id_establecimiento', $supplier_id)->first();

        if ($trackingEstado->estado == 'Sin procesar') { 
            Tracking::where('id_pedido', $order->id)
            ->where('id_establecimiento', $supplier_id)
            ->update(['estado' => 'Procesando']);

            $trackingEstado->estado = 'Procesando';
        }


        return view('order')->with([
            'order' => $order,
            'merchant' => $merchant,
            'establishment' => $establishment,
            'orderProducts' => $orderProducts,
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'estado' => $trackingEstado->estado,
        ]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function readyToShip(Request $request, $orderId){


        Tracking::where('id_pedido', $orderId)
        ->where('id_establecimiento', $request->supplierId)
        ->update(['estado' => 'Listo para retirar']);

        return back()->with('success_message', '¡El estado del pedido ha sido actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
