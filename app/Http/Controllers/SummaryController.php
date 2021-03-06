<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Merchant;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SummaryController extends Controller
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
        $supplier_id = Auth::user()->id_comercio; 
        
        //solicitudes de autorización

        $usersids = DB::table('users')->select('email')->where('estado', 0)->get();

        $usersids = array_column(json_decode($usersids), 'email');
    
        $usersids =  DB::table('merchants')->select('email')->whereIn('email', $usersids)->where('tipo', 'S')->get();

        $usersids = array_column(json_decode($usersids), 'email');

        $users =  DB::table('users')->whereIn('email', $usersids)->where('id_comercio', $supplier_id)->get();

      
        //resumen de pedidos

        $usersOrders = User::select('id')->where('id_comercio', $supplier_id)->get();

        $orders = DB::table('orders')->where('pago_exitoso', 1)->whereIn('user_id', $usersOrders)->take(5)->get();

        
        return view('summary')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'user' => auth()->user(), 
            'users' => $users,
            'orders' => $orders
        ]);
    }
}
