<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Merchant;
use App\Rules\isMerchant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/establishment-info';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $v = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'nombre' => ['required', 'string', 'max:45'],
            'apellido' => ['required', 'string', 'max:45'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['required', 'string', 'max:45'],
            'id_comercio' => ['required_unless:comercioNuevo,si'] 
        ]);


        $v->sometimes('id_comercio', new isMerchant , function ($input) {
            return $input->id_comercio !== null;
        });


        return $v;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $merchant = new Merchant;

        $merchant->email = $data['email'];
        $merchant->establishment_id = $data['id_comercio'];

        if (empty($data['id_comercio'])) {
            $merchant->tipo = 'J';
        }

        $merchant->save();


        return User::create([
            'email' => $data['email'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'password' => Hash::make($data['password']),
            'telefono' => $data['telefono'],
            'id_comercio' => $data['id_comercio']
        ]);
        

    }
}
