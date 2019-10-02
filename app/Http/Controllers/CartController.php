<?php


namespace App\Http\Controllers;

use App\Order;
use App\Category;
use App\Tracking;
use App\Subcategory;
use MercadoPago\SDK;
use App\OrderProduct;
use App\Product_type;
use MercadoPago\Item;
use MercadoPago\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;


SDK::setAccessToken('TEST-4146618151334276-092015-3f842989ff0b99f073f93d97af859103-472786077');

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $categories = Category::all();
        $subcategories = Subcategory::all();


        return view('cart')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
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
     * @param  \App\Product_type  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Product_type $product)
    {
        $duplicados = Cart::search(function ($carItem, $rowId) use ($product){
            return $carItem->id === $product->id;
        });

        if ($duplicados->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', '¡Ya has agregado este producto!');
        }

        $cant = $_POST['selectCantidad'];

        if ($cant > 100 || $cant < 10) {
            return redirect()->route('cart.index')->with('error_message', '¡Cantidad Inválida!');
        }

        Cart::add($product->id, $product->nombre, $cant, $product->precio)->associate('App\Product_type');


        return redirect()->route('cart.index')->with([
            'success_message' => '¡El producto ha sido añadido al Pedido!',  
        ]);
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
        $validator = Validator::make($request->all(), [
            'cantidad' => 'required|numeric|between:1,10'
        ]);

        if ($validator->fails()) {
            return response()->json(['success', false], 400);
        }
 
        Cart::update($id, $request->cantidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', '¡El producto ha sido eliminado del pedido!');
    }


    /**
     * Pago completado
     *
     * @return \Illuminate\Http\Response
     */
    public function procesar(Request $request)
    {
        Cart::destroy();

        Order::where('id', $request->external_reference)
          ->update(['pago_exitoso' => 1]);
 
        return view('procesar-pago')->with([
            'status' => $request->payment_status,
            'order_id' => $request->external_reference,
        ]);
      
    }

    /**
     * Confirmación del pedido
     *
     * @return \Illuminate\Http\Response
     */
    public function orderConfirm()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $productsArray = Cart::content();
        $preference = new Preference();
        $i_arr = array();
        $items_ids = array();


        if (Cart::count() > 0) {

                //crear pedido 


            $order = Order::create([
                'user_id' => Auth::user()->id,
                'subtotal' => Cart::subtotal(),
            ]);

            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'cantidad'=> $item->qty,
                ]);


            }


            //crear seguimientos del pedido

            foreach (Cart::content() as $item) {
                $items_ids[] = $item->id; //array de id's de los productos que hay en el pedido
            }
    
            $orderEstablishments = DB::table('product_types')->select('establishment_id')->whereIn('id', $items_ids)->distinct()->get(); // id's de los proveedores que tienen productos en el pedido

            for ($i=0; $i < count($orderEstablishments) ; $i++) { 
                Tracking::create([
                    'lugar' => 'Establecimiento del Proveedor',
                    'estado' => 'A Procesar',
                    'id_pedido' => $order->id,
                    'id_establecimiento' => $orderEstablishments[$i]->establishment_id,
                ]);
            }


            //Preferencia mercadopago


            foreach ($productsArray as $x => $product) {

                $item = new Item();
                $item->id = $product->id;
                $item->title = $product->name;
                $item->quantity = $product->qty;
                $item->currency_id = "UYU";
                $item->unit_price = $product->price / 100;
                
                $i_arr[] = $item;

            }

            $preference->binary_mode = true;

            $preference->external_reference = $order->id;

            $preference->items = $i_arr;
            
            $preference->save();    
        }

    
        return view('order-confirmation')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'preference'=> $preference,
        ]);
      
    }
}
