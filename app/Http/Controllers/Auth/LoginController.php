<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Requirement;

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

    protected function authenticated()
    {
        $user = auth()->user();
        if (! $user->selected_requirement_id)  {
            if ($user->is_admin  || $user->is_client){
                $user->selected_requirement_id = Requirement::first()->id;
                                
            }else{ //Soporte
                // Y si el usuario de soporte no esta asociado a ningun requerimiento
                $user->selected_requirement_id = $user->requirements->first()->id;

            }
            $user->save();
        }
    }
}
