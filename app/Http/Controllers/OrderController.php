<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Category;
use App\Tracking;
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
    public function index()
    {


        $supplier_id = Auth::user()->id_comercio; //id proveedor

        // $users = User::where('id_comercio', $supplier_id)->get();  //usuarios que trbajan en mi establecimiento

        $orders_id = Tracking::select('id_pedido')->where('id_establecimiento', $supplier_id)->get();

        $orders = DB::table('orders')->whereIn('id', $orders_id)->get(); // todos los pedidos 



        // $test = json_decode($orders);

        // dd(array_column($test, 'user_id'));

        // $establishment = DB::table('establishments')->select('nombre')->whereIn('id', $orders->user_id);

       
        return view('gestionar-pedidos')->with([
            'orders' => $orders,
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

        // dd($orderProducts);
    
        $products = DB::table('product_types')->whereIn('id', array_column($orderProducts, 'product_id'))->get();

        return view('order')->with([
            'order' => $order,
            'products' => $order,
            'merchant' => $merchant,
            'establishment' => $establishment,
            'orderProducts' => $orderProducts,
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
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
