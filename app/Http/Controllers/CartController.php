<?php


namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use MercadoPago\SDK;
use App\Product_type;
use MercadoPago\Item;
use MercadoPago\Preference;
use Illuminate\Http\Request;
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
        
        $productsArray = Cart::content();

        $preference = new Preference();
        
        $i_arr = array();

        foreach ($productsArray as $x => $product) {

            $item = new Item();
            $item->id = $product->id;
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->currency_id = "UYU";
            $item->unit_price = $product->price / 100;
            $i_arr[] = $item;

        }

        $preference->items = $i_arr;

        $preference->save();
        
        return view('cart')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'preference' => $preference,
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

        if ($cant > 10 || $cant < 1) {
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
}
