<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Requirement;
use App\RequirementUser;

class UserController extends Controller
{
    public function index()
    {
        //$users = User::all();        
        $users = User::where('role',1)->get();//Solo muestra los usuarios que son de soporte
        return view('admin.users.index')->with(compact('users'));
    }

    public function store(Request $request)
    {
        
        $rules  = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:120|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];

        $messages = [
            'name.required' =>  'Es necesario ingresar el nombre del usuario',
            'name.max'  =>      'El nombre es demasiado extenso',
            'email.required' =>  'Es obligatorio ingresar el e-mail del usuario.',
            'email.email'   =>   'El e-mail ingresado no es valido.',
            'email.max'  =>      'El e-mail ingresado es demasiado extenso',
            'email.unique'  =>      'Este e-mail ya se encuentra en uso',
            'password.required'  =>      'Olvido ingresar una Contraseña',
            'password.min'  =>      'La Contraseña debe presentar por lo menos 6 caracteres',
            'password_confirmation.required' =>   'La Contraseña no coincide con la introducida anteriormente',


        ];

        $this->validate($request, $rules, $messages);


        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
       // $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 1;//Se le asigna uno por defecto para los usuarios de soporte
        
        $user->save();

        // dd($request->all());
        return back()->with('notification', 'Usuario registrado correctamente');
        //return view();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $requirements = Requirement::all();

        $requirements_user = RequirementUser::where('user_id', $user->id)->get();

        return view('admin.users.edit')->with(compact('user','requirements','requirements_user'));
    }

    public function update($id, Request $request)
    {
        
        $rules  = [
            'name' => 'required|max:255',            
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];

        $messages = [
            'name.required' =>  'Es necesario ingresar el nombre del usuario',
            'name.max'  =>      'El nombre es demasiado extenso',            
            'password.min'  =>  'La Contraseña debe presentar por lo menos 6 caracteres',
            'password_confirmation.required' =>   'La Contraseña no coincide con la introducida anteriormente',

        ];

        $this->validate($request, $rules, $messages);

        $user = User::find($id);

        $user->name = $request->input('name');
        $password = $request->input('password');

        if ($password) //Solo se modifica la contrasena si recibe una nueva, de lo contrario se queda igual
            {
                $user->password = bcrypt($password); 
            }         
        //dd($user);
        $user->save();

        //return view('admin.users.index')->with('notification', 'Usuario modificado correctamente');
        
        return back()->with('notification', 'Usuario modificado correctamente');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('notification', 'Usuario suspendido correctamente');
        
    }
}
