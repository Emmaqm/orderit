<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request) {
        return array_merge($request->only($this->username(), 'password'), ['estado' => 1]);
      }
  
      /**
       * Get the failed login response instance.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\RedirectResponse
       */
      protected function sendFailedLoginResponse(Request $request)
      {
          $errors = [$this->username() => trans('auth.failed')];
  
          // Load user from database
          $user = User::where($this->username(), $request->{$this->username()})->first();
  
          // Check if user was successfully loaded, that the password matches
          // and active is not 1. If so, override the default error message.
          if ($user && \Hash::check($request->password, $user->password) && $user->estado != 1) {
              $errors = [$this->username() => trans('auth.noactive')];
          }
  
          if ($request->expectsJson()) {
              return response()->json($errors, 422);
          }
          return redirect()->back()
              ->withInput($request->only($this->username(), 'remember'))
              ->withErrors($errors);
      }
}
