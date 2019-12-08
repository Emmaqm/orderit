<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Merchant;
use App\Subcategory;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $categories = Category::all();
        $subcategories = Subcategory::all();

        
        return view('edit-user')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'user' => auth()->user(), 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'nombre' => ['required', 'string', 'max:45'],
            'apellido' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,'.auth()->id()],
            'telefono' => ['required', 'string', 'max:45'],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
        ]);

        
        $user = auth()->user();
        $merchant = Merchant::where('email', $user->email)->first();

        $input = $request->except('password', 'password_confirmation');

        
        if (! $request->filled('password')) {
            
            $user->fill($input)->save();
            $merchant->email = $input['email'];
            $merchant->save();
            
            return back()->with('success_message', 'Datos actualizados correctamente');
        }

        $user->password = bcrypt($request->password);
        
        $user->fill($input)->save();
        $merchant->email = $input['email'];
        $merchant->save();

        return back()->with('success_message', 'Datos y contraseña actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {

        User::where('email', $email)->delete();

        Merchant::where('email', $email)->delete();

        return back();

    }

    /**
     * Autorize de user to login
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function autorize($email)
    {
        User::where('email', $email)->update(['estado' => 1]);

        return back();
    }
}
