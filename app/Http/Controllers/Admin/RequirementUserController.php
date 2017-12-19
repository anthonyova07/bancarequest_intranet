<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RequirementUser;

class RequirementUserController extends Controller
{
    public function store(Request $request)
    {

        // El nivel pertenezca al requerimiento
        // Asegurar que el requerimiento exista.
        // Asegurar que el nivel exista.
        // Asegurar que el usuario exista.
        
        $requirement_id = $request->input('requirement_id');
        $user_id = $request->input('user_id');

        $requirement_user = RequirementUser::where('requirement_id', $requirement_id)
                                                ->where('user_id', $user_id)->first();
        
        if ($requirement_user)
            return back()->with('notification', 'El usuario ya pertenece a este requerimiento.');                                        



        $requirement_user =  new RequirementUser();
        $requirement_user->requirement_id = $requirement_id;
        $requirement_user->user_id = $user_id ;
        $requirement_user->level_id = $request->input('level_id');
        $requirement_user->save();

        return back();

    }

    public function delete($id)
    {
        RequirementUser::find($id)->delete();
        return back();
    }

}
