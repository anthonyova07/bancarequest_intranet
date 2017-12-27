<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Requirement;
use App\RequirementUser;

class IncidentController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {

        

        $incident = Incident::findOrFail($id);
       
        return view('incidents.show')->with(compact('incident'));
    }


    public function create() 
    {
        $requirements = DB::table('requirements')->where('id','>=',1)->get();
        // //$categories = Category::find($id);
        $categories = DB::table('categories')->where('id','>=',1)->get();

        $levels = DB::table('levels')->where('id','>=',1)->get();
        // //$categories = Category::where('requirement_id',$id=1)->get();


        // $categories = Category::where('requirement_id', 1)->get();
        return view('incidents.create')->with(compact('categories'));
        //->with(compact('categories'));
    }

    public function store(Request $request) 
    {

        $validatedData = $request->validate([
            'category' => 'sometimes|required|exists:categories,id',
            'priority' => 'required|in:B,M,A',
            'title' => 'required|min:5',
            'description' => 'required|min:15',
            
        ]);

        
        //$request->input('category') ?: null; //Esta expresion evalua si es falsa devuelve null

        $incident = new Incident();
    
        $incident->category_id = $request->input('category_id') ?: null; 
        $incident->priority = $request->input('priority');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        
               
        
        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->requirement_id = $user->selected_requirement_id;
        $incident->level_id = Requirement::find($user->selected_requirement_id)->first_level_id;
        // $incident->support_id = $user->id;

        // dd($incident->level_id);
        
        $incident->save();
       
        // dd($request->all());
        //return $request->all();
        
        return back()->with('notification', 'La solicitud se ha registrado correctamente');
        
    }


    public function take($id)
    {
        $user = auth()->user();

        if (!($user->is_support || $user->is_admin))
            return back();

        $incident = Incident::findOrFail($id);

        //Existe alguna relacion entre el usuario y el requerimiento?
        $requirement_user = RequirementUser::where('requirement_id', $incident->requirement_id)
                                                ->where('user_id', $user->id)->first();
        if (! $requirement_user)
            return back(); 
        //El nivel es el mismo? 
        if ($requirement_user->level_id != $incident->level_id)
            return back(); 

        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    public function solve($id)
    {
        $incident = Incident::findOrFail($id);

        if ($incident->client_id  != auth()->user()->id)
            {
                return back();
            }
        $incident->state = 0;
        $incident->save();

        return back();
        
    }

    public function open($id)
    {
        $incident = Incident::findOrFail($id);

        if ($incident->client_id  != auth()->user()->id)
        {
            return back();
        }
        $incident->state = 1;
        $incident->save();

        return back();
        
    }

    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        
    }

    public function nextLevel($id)
    {
        $incident = Incident::findOrFail($id);
        
    }

}
