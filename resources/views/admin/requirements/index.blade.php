@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Solicitar Requerimiento</div>

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
                 <input type="text"  name="name" placeholder="Introduzca el titulo del requerimiento" class="form-control" value="{{  old('name') }}">                        
                                 
             </div>

             <div class="form-group">
                 <label for="description">Descripcion</label>
                 <textarea name="description" rows="5" placeholder="Introduzca una breve descripcion..." class="form-control" value="{{  old('description') }}"></textarea>                        
                
             </div>

             <div class="form-group">
                 <label for="start">Fecha de inicio</label>
                 <input type="date" name="start"  class="form-control" readonly value="{{  old('start', date('Y-m-d')) }}">                        
             </div>
          
            <div class="form-group">
                <button class="btn btn-primary">Enviar Requerimiento</button>
                                               
            </div>
        </form>

        <table class ="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Fecha de inicio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requirements as $requirement)
                <tr>
                    <td class="col-md-2">{{$requirement->name}}</td>
                    <td class="col-md-6">{{$requirement->description}}</td>
                    <td class="col-md-3">{{$requirement->start ?: 'No se ha indicado'}}</td><!--Cuando no tiene valor de fecha este lo especifica -->
                    <td class="col-md-1">
                        
                        @if ($requirement->trashed())
                        <a href="/requerimiento/{{ $requirement->id }}/restaurar" onclick="return confirm('Seguro que quieres restarurar este requerimiento?')" class="btn btn-sm btn-success" title="Restaurar">
                            <span class="glyphicon glyphicon-repeat"></span>
                        </a>
                        @else
                        <a href="/requerimiento/{{ $requirement->id }}"  onclick="return confirm('Seguro que quieres editar este requerimiento?')" class="btn btn-sm btn-primary" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        
                        <a href="/requerimiento/{{ $requirement->id }}/eliminar" onclick="return confirm('Seguro que quieres eliminar este requerimiento?')" class="btn btn-sm btn-danger" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>                        
                        @endif               
                    </td>
                </tr>
                @endforeach
            </tbody>



        </table>
    </div>
</div>
@endsection
