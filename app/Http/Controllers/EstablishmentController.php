<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Merchant;
use App\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablishmentController extends Controller
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

        $user = Auth::user();

        
        if ($user->id_comercio == null) {

            return view('registerEstablishment-supplier');

        }else{
            
            return redirect()->route('home.index');

        }


        
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $ismerchant = Merchant::where('email', $user->email)->first();


        $validatedData = $request->validate([
            'nombre' => 'required|max:100|string',
            'direccion' => 'required|max:250|string',
            'telefono' => 'required|max:45|string',
        ]);


        if($ismerchant == null){
            $data = Establishment::create([
                'nombre' => $request['nombre'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'tipo' => 'P',
            ]);

            Employee::where('email', $user->email)
            ->update(['establishment_id' => $data->id]);

        }else{

            $data = Establishment::create([
                'nombre' => $request['nombre'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'tipo' => 'C',
            ]);

            
            Merchant::where('email', $user->email)
            ->update(['establishment_id' => $data->id]);
        }
        
        User::where('id', $user->id)
        ->update(['id_comercio' => $data->id]);


        return redirect()->route('establishment.pending')->with('message', $request['nombre']);
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


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

    public function pending(Request $request)
    {
        return view('activation-pending');
    }
}
