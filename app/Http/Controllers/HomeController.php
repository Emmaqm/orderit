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
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $paginate = 10;

        if (request()->category) {
            $products = Product_type::with('subcategories')->whereHas('subcategories', function($query){
                $query->where('nom_low', request()->category);
            });
            $categoryName = optional($subcategories->where('nom_low', request()->category)->first())->nombre;

        } else {
            $products = Product_type::where('destacado', true)->inRandomOrder();
            $categoryName = 'Productos Destacados';
        }
        
        if (request()->sort == 'low_high') {
            $products = $products->orderBy('precio')->paginate($paginate);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('precio' , 'desc')->paginate($paginate);
        } else {
            $products = $products->paginate($paginate);
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

        $product = Product_type::where('nombre', $slug)->firstOrFail();
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

    public function search(Request $request)
    {

        $categories = Category::all();
        $subcategories = Subcategory::all();
        
        return view('search-results')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}
