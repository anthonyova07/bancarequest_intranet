<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\User;
use App\RequirementUser;



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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $my_incidents = Incident::where('requirement_id', 1)
                    ->where('support_id',$user->id)->get();

        $requirementUser = RequirementUser::where('requirement_id', 1)
                    ->where('user_id',$user->id)->first();

        $pending_incidents = Incident::where('support_id', null)
                    ->where('level_id',$requirementUser['level_id'])->get();

        $incidents_by_me = Incident::where('client_id', $user->id)
                    ->where('requirement_id',1);

        // dd($pending_incidents);
        return view('home')->with(compact('my_incidents','pending_incidents','incidents_by_me'));
        // ->where('support_id',$requirementUser->level_id)
    }

    public function selectRequirement($id)
    {
        //validar que el usuario este asociado con el requerimiento
        $user = auth()->user();
        $user->requirement_id = $id;
        $user->save();

        return back();
    }


   
}
