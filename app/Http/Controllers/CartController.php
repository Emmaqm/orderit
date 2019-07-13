<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product_type;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

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

        Cart::add($product->id, $product->nombre, 1, $product->precio)
              ->associate('App\Product_type');

        return redirect()->route('cart.index')->with('success_message', '¡El producto ha sido añadido al Pedido!');
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
