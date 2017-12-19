@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Editar Requerimiento</div>

    <div class="panel-body">
    <!--Con esta sentencia if se valida si existe la variable de sesion llamada notification -->
        @if (session('notification'))
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('notification') }}</strong>
            </div>           
        @endif 
     <!--Con esta sentencia if se valida si el conteo de errores es mayor a 0 para luego mostrarlos en detalle en la pantalla -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error  }}</li>
                    @endforeach
                </ul>
            </div>           
        @endif
        
        <form action="" method="POST">
            {{  csrf_field()  }}          

            <div class="form-group">
                 <label for="name">Nombre</label>
                 <input type="text" name="name" placeholder="Introduzca el titulo del requerimiento" class="form-control" value="{{  old('name', $requirement['name']) }}">                        
             </div>

             <div class="form-group">   
                 <label for="description">Descripcion</label>
                 <textarea type="text" rows="5" name="description" placeholder="Introduzca una breve descripcion..." class="form-control" value="{{  old('description', $requirement['description']) }}">{{ $requirement['description'] }}</textarea>                         
             </div>

             <div class="form-group">
                 <label for="start">Fecha de inicio</label>
                 <input type="date" name="start"  class="form-control"  value="{{  old('start', $requirement['start']) }}">                        
             </div>
          
            <div class="form-group">
                <button class="btn btn-primary">Guardar Requerimiento</button>
                                               
            </div>
        </form>

        <div class="row">
             <div class="col-md-6">          
                <h4>Categorias</h4>                
                <form action="/categorias" method="POST" class="form-inline">
                {{  csrf_field()  }} 
                <input type="hidden" name="requirement_id" value="{{   $requirement['id']  }}" >                             
                <div class="form-group">                    
                    <input type="text" name="name" placeholder="Introduzca el nombre" class="form-control" >                        
                </div>                         
                <div class="form-group">
                    <button class="btn btn-primary">Anadir</button>                                               
                </div>
                
                </form>
                <table class ="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>                    
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($categories as $category)
                        <tr>                             
                            <td> {{$category->name}} </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{  $category->id }}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <a href="/categoria/{{ $category->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>               
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-6">          
                <h4>Niveles</h4>
                <form action="/niveles" method="POST" class="form-inline">
                {{  csrf_field()  }}   
                <input type="hidden" name="requirement_id" value="{{   $requirement['id'] }}" >  
                <div class="form-group">                    
                    <input type="text" name="name" placeholder="Introduzca el nombre" class="form-control" >                        
                </div>
                         
                <div class="form-group">
                    <button class="btn btn-primary">Anadir</button>                                               
                </div>
                
                </form>
               <table class ="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>Opciones</th>                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($levels as $key=> $level)                       
                        <tr>                            
                            <td>N{{ $key+1 }}</td>
                            <td>{{ $level->name }}</td>
                           
                            <td>
                                <button type="button"  class="btn btn-sm btn-primary" title="Editar"  data-level="{{  $level->id }}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <a href="/nivel/{{ $level->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Categoria</h4>
      </div>
      <form action="/categoria/editar" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">            
                <input type="hidden" name="category_id" id="category_id"  value="">
                <div class="form-group">
                    <label for="name">Nombre de la Categoria</label>
                    <input type="text" name="name" class="form-control" id="category_name" value="">
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditLevel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Nivel</h4>
      </div>
      <form action="/nivel/editar" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">            
                <input type="hidden" name="level_id" id="level_id"  value="">
                <div class="form-group">
                    <label for="name">Nombre del nivel</label>
                    <input type="text" name="name" class="form-control" id="level_name" value="">
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
      </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('scripts')
    <script src="/js/admin/projects/edit.js"></script>

@endsection
