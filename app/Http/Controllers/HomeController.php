<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product_type;
use Illuminate\Http\Request;

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

        if (request()->category) {
            $products = Product_type::with('subcategories')->whereHas('subcategories', function($query){
                $query->where('nom_low', request()->category);
            })->get();
            $categories = Category::all();
            $subcategories = Subcategory::all();
            $categoryName = $subcategories->where('nom_low', request()->category)->first()->nombre;

        } else {
            $products = Product_type::inRandomOrder()->get();
            $categories = Category::all();
            $subcategories = Subcategory::all();
            $categoryName = 'Productos Destacados';
        }
        
        if (request()->sort == 'low_high') {
            $products = $products->sortBy('precio');
        } elseif (request()->sort == 'high_low') {
            $products = $products->sortByDesc('precio');
        }
        

        return view('home')->with([
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'categoryName' => $categoryName,
        ]);
    }

    public function show($slug)
    {
        $slug = explode("-", $slug);

        $product = Product_type::where('nombre', $slug[1])->firstOrFail();
        $alsoLike = Product_type::where('nombre', '!=' , $slug)->inRandomOrder()->take(6)->get();

        $categories = Category::all();
        $subcategories = Subcategory::all();


        return view('product')->with([
            'product' => $product,
            'alsoLike' => $alsoLike,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);

    }
}
