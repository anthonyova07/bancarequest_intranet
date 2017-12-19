<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Requirement;
use App\Level;
use App\Category;


class ProjectController extends Controller
{
    public function index()
    {   
        //Se obtienen todos los requerimientos con este metodo que los excluye del resultado del query y con este metodo withTrashed forza a que aparezcan
        $requirements = Requirement::withTrashed()->get();
        return view('admin.requirements.index')->with(compact('requirements'));
    }

    public function store(Request $request)
    {

        $rules  = [
            'name' => 'required|string|min:10|max:125',            
            'description' => 'min:10|required|max:500',
            'start' =>  'required|date'
        ];
    
        $messages = [
            'name.required' =>  'Es necesario ingresar un titulo para el requerimiento',  
            'name.min'      =>  'El titulo debe contener por lo menos 10 caracteres',     
            'name.max'  =>      'Ha sobrepasado la cantidad maxima(125) de caracteres para el titulo.',
            'description.min' =>  'La descripcion debe presentar por lo menos 10 caracteres.',
            'description.required'   =>   'Olvido ingresar una descripcion.',
            'description.max'   =>   'Ha sobrepasado la cantidad maxima de caracteres permmitida de 500 caracteres.',
            'start.date'  =>      'La fecha no tiene un formato adecuado',
            'start.required'     =>  'La fecha de inicio es obligatoria introducirla.',          
            
        ];

        //Se acceden a las reglas a traves de la clase requirement
        $this->validate($request,$rules, $messages);
        
        $requirement = new Requirement();
        $requirement->name = $request->input('name');
        $requirement->description = $request->input('description');
        $requirement->start = $request->input('start');

        // Requirement::create($request->all());

        $requirement->save();

        //$requirements =  Requirement::create($request->all());//Se pasan todos los valores que provienen de la peticion
       

                
        return back()->with('notification', 'El requerimiento se ha registrado correctamente');
    }

    public function edit($id)
    {    
        
        $requirement = Requirement::find($id);//Se pasa el valor correspondiente al id solicitado que proviene de la peticion
        
        
        $levels = Level::all();      
        $categories = Category::all();                 

        //permite retornar la vista de requerimientos al administrador que ya tiene asignado
        //permitiendo actualizarlos en funcion de la data que ya esta asignada
              
        return view('admin.requirements.edit')->with(compact('requirement','categories','levels'));


    }

    public function update($id, Request $request)
    {

        $rules  = [
            'name' => 'required|string|min:10|max:125',            
            'description' => 'min:10|required|max:500',
            
        ];
    
        $messages = [
            'name.required' =>  'Es necesario ingresar un titulo para el requerimiento',  
            'name.min'      =>  'El titulo debe contener por lo menos 10 caracteres',     
            'name.max'  =>      'Ha sobrepasado la cantidad maxima(125) de caracteres para el titulo.',
            'description.min' =>  'La descripcion debe presentar por lo menos 10 caracteres.',
            'description.required'   =>   'Olvido ingresar una descripcion.',
            'description.max'   =>   'Ha sobrepasado la cantidad maxima de caracteres permmitida de 500 caracteres.',
                        
        ];

        //Se acceden a las reglas a traves de la clase requirement
        $this->validate($request, $rules,$messages);
        
        $requirement = Requirement::find($id);

        $requirement->name = $request->input('name');
        $requirement->description = $request->input('description');
        $requirement->start = $request->input('start');
        
        //Requirement::find($id)->update($request->all());//Se busca el requerimiento por su id y luego se le asignan los valores ya definidos
       
        $requirement->save();
        return back()->with('notification', 'El requerimiento se ha actualizado correctamente');
    }

    public function delete($id)
    {

        $requirement = Requirement::find($id);
        $requirement->delete();
        //Requirement::find($id)->delete();
        

        return back()->with('notification', 'El requerimiento se ha suspendido correctamente');
        
    }

    public function restore($id)
    {
        //Con el metodo find devuelve un objeto y cuando se quiere restaurar no lo encuentra
        //con el withTrashed se busca ese valor y luego con el id y restore se trae de vuelta
        Requirement::withTrashed()->find($id)->restore();

        return back()->with('notification', 'El requerimiento se ha habilitado correctamente');
        
    }
}
