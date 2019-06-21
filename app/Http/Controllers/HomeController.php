<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $products = Product::inRandomOrder()->get();


        return view('home')->with('products', $products);
    }

    public function show($slug)
    {
        $slug = explode("-", $slug);

        $product = Product::where('nombre', $slug[1])->firstOrFail();
        $alsoLike = Product::where('nombre', '!=' , $slug)->inRandomOrder()->take(6)->get();


        return view('product')->with([
            'product' => $product,
            'alsoLike' => $alsoLike,
        ]);

    }
}
