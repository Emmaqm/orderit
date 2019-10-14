<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cantPedidos = [];

        $earnings = 0;
        $earningsLM = 0;

        $percentageTotalCant = 0;
        $percentageMerchantsCant = 0;
        $percentageEarnings = 0;
        
        $supplier_id = Auth::user()->id_comercio; //id proveedor


        //Productos mas vendidos

        $productsIds = DB::table('product_types')->select('id')->where('establishment_id', $supplier_id)->get();

        $productsIds = array_column(json_decode($productsIds), 'id');

        if (($request->year == 'ally' and $request->month == 'allm' ) or (empty($request->year) and empty($request->month))) {

            $cantidades = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->get();
            $ordersIds = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->get();
            $trackings = DB::table('trackings')->where('id_establecimiento', $supplier_id)->get();

        }elseif ($request->year == 'ally' and !empty($request->month)) {
            
            $cantidades = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereMonth('created_at', '=', $request->month)->get();
            $cantidadesLM = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereMonth('created_at', '=', $request->month - 1)->get();

            $ordersIds = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month)->get();
            $ordersIdsLM = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month - 1)->get();

            $trackings = DB::table('trackings')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month)->get();

        }elseif ($request->month == 'allm' and !empty($request->year)) {
            
            $cantidades = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereYear('created_at', '=', $request->year)->get();
            $cantidadesLM = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereYear('created_at', '=', $request->year - 1)->get();

            $ordersIds = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereYear('created_at', '=', $request->year)->get();
            $ordersIdsLM = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereYear('created_at', '=', $request->year - 1)->get();

            $trackings = DB::table('trackings')->where('id_establecimiento', $supplier_id)->whereYear('created_at', '=', $request->year)->get();
            
        }elseif (!empty($request->year) and !empty($request->month)) {
            
            $cantidades = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereMonth('created_at', '=', $request->month)->whereYear('created_at', '=', $request->year)->get();
            $cantidadesLM = OrderProduct::select('product_id', 'cantidad')->whereIn('product_id', $productsIds)->whereMonth('created_at', '=', $request->month - 1)->whereYear('created_at', '=', $request->year)->get();
            
            $ordersIds = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month)->whereYear('created_at', '=', $request->year)->get();
            $ordersIdsLM = DB::table('trackings')->select('id_pedido')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month - 1)->whereYear('created_at', '=', $request->year)->get();
            
            $trackings = DB::table('trackings')->where('id_establecimiento', $supplier_id)->whereMonth('created_at', '=', $request->month)->whereYear('created_at', '=', $request->year)->get();

        }else{
            abort(404);
        }

        $cantidades = json_decode($cantidades);

        $products = [];
        

        for ($i=0; $i < count($cantidades) ; $i++) { 
            
            $item = [];

            $key = $cantidades[$i]->product_id;

            $item['product_id'] = $cantidades[$i]->product_id;
            $item['cantidad'] = $cantidades[$i]->cantidad;
          
            $productInfo = DB::table('product_types')->select('id','nombre', 'imagen_url', 'precio')->where('id', $key)->first();
        
            $item = array_merge((array)$productInfo, $item);

            if (array_key_exists($key, $products)) {
                $products[$key]['cantidad'] += $cantidades[$i]->cantidad;
            }else{
                $products[$key] = $item;
            }

           
        }

        if (isset($cantidadesLM)) {

            $productsLM = [];

            for ($i=0; $i < count($cantidadesLM) ; $i++) { 
            
                $item = [];
    
                $key = $cantidadesLM[$i]->product_id;
    
                $item['product_id'] = $cantidadesLM[$i]->product_id;
                $item['cantidad'] = $cantidadesLM[$i]->cantidad;
              
                $productInfo = DB::table('product_types')->select('id','nombre', 'imagen_url', 'precio')->where('id', $key)->first();
            
                $item = array_merge((array)$productInfo, $item);
    
                if (array_key_exists($key, $productsLM)) {
                    $productsLM[$key]['cantidad'] += $cantidadesLM[$i]->cantidad;
                }else{
                    $productsLM[$key] = $item;
                }
    
            }
        }

        // Cantidad de pedidos segun el estado 

        $keys = array('sinproc', 'proc', 'retirar', 'retirados');
        
        $cantPedidos = array_fill_keys($keys, 0);

        foreach ($trackings as $tracking) {

            if ($tracking->estado == "Sin procesar") {
                
                $cantPedidos['sinproc'] ++;

            }else if ($tracking->estado == "Procesando"){
                
                $cantPedidos['proc'] ++;

            }elseif ($tracking->estado == 'Listo para retirar') {
                
                $cantPedidos['retirar'] ++;

            }elseif ($tracking->estado == 'Retirado') {
                
                $cantPedidos['retirados'] ++;

            }
            
        };

        // Ordenar array por cantidad de producto
        usort($products, function($a, $b) {
            return $b['cantidad'] <=> $a['cantidad'];
        });


        // Estadisticas

                //cantidad de productos vendidos    

        $totalCant = array_sum(array_column($products, 'cantidad')); 

        if (isset($productsLM)) {
            $totalCantLM = array_sum(array_column($productsLM, 'cantidad')); 

            if ($totalCantLM == 0 and $totalCant == 0) {
                $percentageTotalCant = 0;
            }elseif ($totalCantLM == 0 and $totalCant != 0) {
                $percentageTotalCant = 100;
            }elseif ($totalCantLM != 0 and $totalCant == 0) {
                $percentageTotalCant = -100;
            }else {

                if ($totalCantLM > $totalCant) {
                    $percentageTotalCant = -round(100 - ($totalCant * 100 / $totalCantLM), 2);
                }elseif ($totalCant > $totalCantLM) {
                    $percentageTotalCant = round(100 - ($totalCantLM * 100 / $totalCant), 2);
                } 
            }
        }

                // Cantidad de comercios clientes

        $userIds = DB::table('orders')->select('user_id')->whereIn('id', array_column(json_decode($ordersIds), 'id_pedido'))->distinct()->get();
        
        $merchantIds = DB::table('users')->select('id_comercio')->whereIn('id', array_column(json_decode($userIds), 'user_id'))->distinct()->get();

        $merchantsCant = count($merchantIds);
        

        if (isset($ordersIdsLM)) {

            $userIdsLM = DB::table('orders')->select('user_id')->whereIn('id', array_column(json_decode($ordersIdsLM), 'id_pedido'))->distinct()->get();

            $merchantIdsLM = DB::table('users')->select('id_comercio')->whereIn('id', array_column(json_decode($userIdsLM), 'user_id'))->distinct()->get();

            $merchantsCantLM = count($merchantIdsLM);


            if ($merchantsCantLM == 0 and $merchantsCant == 0) {
                $percentageMerchantsCant = 0;
            }elseif ($merchantsCantLM == 0 and $merchantsCant != 0) {
                $percentageMerchantsCant = 100;
            }elseif ($merchantsCantLM != 0 and $merchantsCant == 0) {
                $percentageMerchantsCant = -100;
            }else {

                if ($merchantsCantLM > $merchantsCant) {
                    $percentageMerchantsCant = -round(100 - ($merchantsCant * 100 / $merchantsCantLM), 2);
                }elseif ($merchantsCant > $merchantsCantLM) {
                    $percentageMerchantsCant = round(100 - ($merchantsCantLM * 100 / $merchantsCant), 2);
                } 
            }
        }
        

                // Ganancias totales

        foreach ($products as $product) {
            
           $subtotal =  $product['cantidad'] * $product['precio'];

           $earnings += $subtotal;
        }

        if (isset($productsLM)) {

            foreach ($productsLM as $product) {
            
                $subtotal =  $product['cantidad'] * $product['precio'];
     
                $earningsLM += $subtotal;
            }
            
            if ($earningsLM == 0 and $earnings == 0) {
                $percentageEarnings = 0;
            }elseif ($earningsLM == 0 and $earnings != 0) {
                $percentageEarnings = 100;
            }elseif ($earningsLM != 0 and $earnings == 0) {
                $percentageEarnings = -100;
            }else {

                if ($earningsLM > $earnings) {
                    $percentageEarnings = -round(100 - ($earnings * 100 / $earningsLM), 2);
                }elseif ($earnings > $earningsLM) {
                    $percentageEarnings = round(100 - ($earningsLM * 100 / $earnings), 2);
                } 
            }
        }

        return view('dashboard')->with([
            'cantPedidos' => $cantPedidos, 
            'products' => $products, 
            'totalCant' => $totalCant, 
            'merchantsCant' => $merchantsCant, 
            'earnings' => $earnings, 
            'percentageTotalCant' => $percentageTotalCant, 
            'percentageMerchantsCant' => $percentageMerchantsCant, 
            'percentageEarnings' => $percentageEarnings, 
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
