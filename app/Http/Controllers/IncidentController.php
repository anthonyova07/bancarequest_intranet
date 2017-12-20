<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Requirement;

class IncidentController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create() 
    {
        $requirements = DB::table('requirements')->where('id','>=',1)->get();
        // //$categories = Category::find($id);
        $categories = DB::table('categories')->where('id','>=',1)->get();

        $levels = DB::table('levels')->where('id','>=',1)->get();
        // //$categories = Category::where('requirement_id',$id=1)->get();


        // $categories = Category::where('requirement_id', 1)->get();
        return view('report')->with(compact('categories'));
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
        // $incident->requirement_id = $user->selected_requirement_id;
        // $incident->level_id = Requirement::find($user->selected_requirement_id)->first_level_id;
        
        // dd($incident->level_id);
        
        $incident->save();
       
        // dd($request->all());
        //return $request->all();
        
        return back()->with('notification', 'La solicitud se ha registrado correctamente');
        
    }
}
