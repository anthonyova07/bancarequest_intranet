<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    use SoftDeletes;

    

    public function store(Request $request)
    {

        
        $this->validate($request, [

            'name'  =>  'required|min:5|max:15',
        ],  [
            'name.required' =>  'Es necesario ingresar un nombre para la categoria.',
        ]);

        

        $category= new Category();
        $category->name = $request->input('name');
        $category->save();

        
        //Category::create($request->all());//Se pasan todos los valores que provienen de la peticion

        return back()->with('notification', 'La Categoria se ha registrado correctamente');
    }

    public function edit($id)
    {
        
       
        // $categories = Category::create($request->all());  
        return view('admin.requirements.edit')->with('categories', $categories);


    }

    public function update(Request $request)
    {
        $this->validate($request, [

            'name'  =>  'required|min:5|max:15',
        ],  [
            'name.required' =>  'Es necesario ingresar un nombre para la categoria.',
        ]);

        

        //$category_id= new Category();
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->name = $request->input('name');
        $category->save();

        
        //Category::create($request->all());//Se pasan todos los valores que provienen de la peticion

        return back()->with('notification', 'La Categoria se ha actualizado correctamente');
    
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return back()->with('notification', 'La Categoria se ha suspendido correctamente');
        
    }

    public function restore($id)
    {
        //Con el metodo find devuelve un objeto y cuando se quiere restaurar no lo encuentra
        //con el withTrashed se busca ese valor y luego con el id y restore se trae de vuelta
        $categories = Category::withTrashed()->find($id)->restore();

        return back()->with('notification', 'La categoria se ha habilitado correctamente');
        
    }

}
